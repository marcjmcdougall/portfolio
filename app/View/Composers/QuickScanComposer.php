<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Models\QuickScan;
use App\Models\Setting;

class QuickScanComposer
{
    /**
     * Includes the newsletter testimonials in every view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Determine if QuickScans are enabled
        $settings = Setting::first();
        $quickScanEnabled = $settings->enable_quick_scan;

        // Pass into the view
        $view->with('quickScanEnabled', $quickScanEnabled);
    }
}
