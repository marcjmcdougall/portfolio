# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project

Laravel 11 application that powers marcmcdougall.com — a portfolio site with content (articles, testimonials, podcast appearances, resources) plus an interactive **QuickScan** feature that audits any URL via headless Chrome + LLMs and emails the report to the visitor.

Stack: PHP 8.2+, Laravel 11, Livewire 3, Laravel Nova 4 (admin), Horizon + Redis (queues), MariaDB (via Docker; SQLite is the example default), Mailpit (local mail), Vite + plain JS/CSS (no JS framework). Sentry for errors. Mailgun for outbound mail.

## Common commands

```bash
# Backend
php artisan serve                 # Local dev server
php artisan migrate               # Run migrations
php artisan horizon               # Start queue workers (required for QuickScan)
php artisan app:scan <url> [id]   # Trigger a QuickScan from the CLI; pass id to re-run an existing record

# Frontend
npm run dev                       # Vite dev server (HMR)
npm run build                     # Production build

# Tests
./vendor/bin/phpunit                                    # All tests
./vendor/bin/phpunit --testsuite=Unit                   # Unit only
./vendor/bin/phpunit --testsuite=Feature                # Feature only
./vendor/bin/phpunit --filter=SomeTest                  # Single test/class

# Lint
./vendor/bin/pint                 # Format PHP (Laravel Pint)

# Local services
docker compose up -d              # MariaDB (port 3307), Mailpit UI (9090), Redis (6379)
```

`.env` must be configured before anything works — see `.env.example`. QuickScan in particular requires `OPENAI_SECRET`, `GEMINI_SECRET`, `GOOGLE_PAGESPEED_SECRET`, `KIT_SECRET`/`KIT_FORM_ID` (ConvertKit), `MAILGUN_*`, `NOCAPTCHA_*`, and `SLACK_BOT_USER_OAUTH_TOKEN`. Set `APP_ADMIN_EMAIL` to your address to bypass the 24-hour QuickScan rate limit when logged in.

Headless Chrome is required on the host (chrome-php drives it). The README has the Ubuntu install snippet; on macOS, install Google Chrome normally.

## Architecture

### QuickScan pipeline (the non-obvious part of this codebase)

`POST /resources/quick-scan` → `QuickScanReportController@store` validates (URL regex, email, reCAPTCHA, consent), applies dual rate limits (IP key + email key, both 24h, 1 attempt — both must be free), then dispatches `App\Jobs\QuickScan\QuickScan`.

The root job orchestrates two stages:

1. **`Bus::chain`** — sequential, with `WithoutOverlapping($url)` middleware so the same URL can't be scanned twice concurrently:
   - `Subscribe` — push visitor to ConvertKit
   - `Fetch` — headless Chrome navigates the URL, captures full HTML + full-page screenshot to `storage/app/public/quick-scans/screenshots/{id}.png`. Detects Cloudflare challenges and fails gracefully. Runs on the dedicated `fetch` queue.
   - `EvaluateThenInform` — kicks off the next stage:

2. **`Bus::batch`** (parallel evaluators) followed by `Inform` (email to visitor) in the `.then()` callback:
   - `EvaluateLoadTime` — Google PageSpeed Insights
   - `EvaluateCopy` — OpenAI/Gemini messaging audit (provider chosen via `LLM_PROVIDER` env)
   - `EvaluateMarkup` — DOM/markup checks via Symfony DomCrawler

Each evaluator updates the `QuickScan` model and calls `$quickScan->addProgress($n)` to advance the visible progress bar (Livewire `QuickScanReport` polls the record).

Failures from any single evaluator do **not** kill the batch; `$quickScan->fail($msg)` writes error state into all `ApiResult` fields and notifies Slack via `SlackNotifier`.

### ApiResult pattern

Any field that holds the outcome of an external API call (HTML fetch, screenshot path, LLM audit, PageSpeed metrics, image count, issues list) is stored as JSON wrapping `{value, status, error, attempts}` via `App\Casts\ApiResultCast` + `App\Helpers\ApiResult`. Statuses: `pending` (initialized in `QuickScan::booted()` on create), `success`, `fail`, `error`. When adding a new async field, register it in both `$fillable`/`$casts` and the `$apiFields` array inside `booted()` so it starts as `pending` instead of `null`.

### Queues

Horizon defines three named queues (see `config/horizon.php`): `default`, `fetch` (dedicated single-process supervisor for Chrome — `Fetch::onQueue('fetch')`), and `important`. The same supervisor layout exists for both `production` and `local` environments. Running `php artisan horizon` (not `queue:work`) is required for jobs to drain in dev.

### Admin (Nova)

`/nova` is gated by `NovaServiceProvider::gate()` — only two hardcoded email addresses can access it. There is no UI for adding admins; edit the provider.

### Routing & misc

- Routes live entirely in `routes/web.php` (no API routes file). Article/Testimonial/PodcastAppearance "topic" archives use `whereJsonContains` against JSON columns.
- The `/start` route uses `transform.video.params` middleware (`App\Http\Middleware\TransformVideoQueryParams`) which rewrites `?v=` into UTM params before the controller runs.
- View composers in `App\View\Composers` inject testimonials and QuickScan stats into specific Blade partials — see `AppServiceProvider::boot()` for the binding list.
- Cleanup of old scans runs daily via `Schedule::job(new Cleanup)` in `routes/console.php` (requires `php artisan schedule:work` or a system cron).

### Frontend

Vite entry points are `resources/css/index.css`, `resources/js/app.js`, and `resources/js/theme-init.js` (loaded early to avoid FOUC for dark mode). No build framework — just modular vanilla JS (animations, lazy loading, theme, typewriter, countUp). Livewire components handle the dynamic QuickScan progress UI.
