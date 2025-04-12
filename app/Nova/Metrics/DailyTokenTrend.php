<?php

namespace App\Nova\Metrics;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Value;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Nova;

use App\Models\ApiUsage;

class DailyTokenTrend extends Trend
{
    /**
     * Calculate the value of the metric.
     */
    public function calculate(NovaRequest $request): TrendResult
    {
        // This uses a raw SQL expression to sum the tokens
        return $this->aggregateByDays(
            $request,
            ApiUsage::class,
            function ($query) {
                return $query->raw('(input_tokens + output_tokens + thought_tokens)');
            }
        );
    }

    /**
     * Get the ranges available for the metric.
     */
    public function ranges(): array
    {
        return [
            7 => '7 Days',
            14 => '14 Days',
            30 => '30 Days',
            60 => '60 Days',
            90 => '90 Days',
        ];
    }

    /**
     * Determine the amount of time the results should be cached.
     */
    public function cacheFor()
    {
        return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'daily-token-trend';
    }
}
