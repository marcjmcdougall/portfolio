<?php

namespace App\Http\Controllers;

use App\Helpers\SlackNotifier;
use App\Models\QuickScan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\RateLimiter;

use App\Jobs\QuickScan\QuickScan as QuickScanJob;


class QuickScanReportController extends Controller
{
    /**
     * Show a single QuickScan report.
     */
    public function show($domain, string $id): View
    {
        // Find the scan by ID
        $quickScan = QuickScan::findOrFail($id);

        // SlackNotifier::error('Test notification');
        
        // Check if the domain in the URL matches the one in the database
        if ($quickScan->domain !== $domain) {
            // If they don't match, throw a 404 error
            abort(404, 'Quick Scan not found');
        }
        
        return view('quick-scan.show', [
            'quickScan' => $quickScan,
        ]);
    }

    /**
     * Create a single QuickScan report.
     */
    public function create(): View
    {
        $totalQuickScans = QuickScan::count();

        return view('quick-scan.create', compact('totalQuickScans'));
    }

    /**
     * Store a newly created quickscan in storage.
     */
    public function store(Request $request)
    {
        // Normalize the URL before validation
        if ($request->has('url')) {
            $normalizedUrl = $this->normalizeUrl($request->url);
            $request->merge(['url' => $normalizedUrl]);
        }

        $request->validate([
            'url' => 'required|url|max:255',
            'email' => 'required|email|max:255',
            'consent' => 'required'
        ]);

        // Check if admin is logged in (and bypass rate limits)
        if (Auth::check() && Auth::user()->email === config('app.admin.email')) {
            // Execute directly
            return $this->processQuickScanCreation($request);
        } else {
            // Apply rate limiting
            $ipAddress = $request->ip();
            $rateLimitKey = 'quickscan_daily_' . $ipAddress;
            
            $executed = RateLimiter::attempt(
                $rateLimitKey,
                1,
                function () use ($request) {
                    // No need to return the result here - RateLimiter::attempt
                    // will return the callback's result automatically
                    return $this->processQuickScanCreation($request);
                },
                60*60*24 // 24 hours
            );
            
            if ( ! $executed) {
                $availableIn = RateLimiter::availableIn($rateLimitKey);
                
                return back()
                    ->withInput()
                    ->withErrors([
                    'limit_reached' => 'You can only create one QuickScan per day. Please try again in ' . 
                                    $this->formatTimeRemaining($availableIn) . '.'
                ]);
            }
            
            // If executed is true but also returned a response, return that
            return $executed;
        }
    }

    /**
     * Process the actual QuickScan creation logic
     */
    protected function processQuickScanCreation(Request $request)
    {
        // Validation
        $request->validate([
            'url' => 'required|url|max:255',
            'email' => 'required|email|max:255',
            'consent' => 'required'
        ]);

        // Create the QuickScan
        $quickScan = new QuickScan();
        $quickScan->url = $request->url;
        $quickScan->email = $request->email;
        $quickScan->save();
        
        // Dispatch the job
        QuickScanJob::dispatch($quickScan);

        return redirect()->route('quick-scan.show', [
            'quickScan' => $quickScan, 
            'domain' => $quickScan->domain
            ])
            ->with('success', 'Quickscan processing started ...');
    }

    /**
     * Normalize a user-entered URL
     * 
     * @param string $url
     * @return string
     */
    protected function normalizeUrl($url)
    {
        // Trim whitespace and trailing slashes
        $url = rtrim(trim($url), '/');
        
        // Add https:// if no protocol is specified
        if (!preg_match('~^(?:f|ht)tps?://~i', $url)) {
            $url = 'https://' . $url;
        }
        
        return $url;
    }

    /**
     * Format seconds into a human-readable time remaining
     */
    protected function formatTimeRemaining($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        
        if ($hours > 0) {
            return $hours . ' hour' . ($hours > 1 ? 's' : '') . 
                ($minutes > 0 ? ' and ' . $minutes . ' minute' . ($minutes > 1 ? 's' : '') : '');
        }
        
        return $minutes . ' minute' . ($minutes > 1 ? 's' : '');
    }
}
