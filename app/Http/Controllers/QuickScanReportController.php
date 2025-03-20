<?php

namespace App\Http\Controllers;

use App\Models\QuickScan;
use Illuminate\Http\Request;
use Illuminate\View\View;

use App\Jobs\QuickScan\QuickScan as QuickScanJob;


class QuickScanReportController extends Controller
{
    /**
     * Show a single QuickScan report.
     */
    public function show(string $id): View
    {
        // Just check if the scan exists and pass ID to the view
        $quickScan = QuickScan::findOrFail($id);
        
        return view('quick-scan.show', [
            'quickScan' => $quickScan,
        ]);
    }

    /**
     * Show a single QuickScan report.
     */
    public function create(): View
    {
        return view('quick-scan.create');
    }

    /**
     * Store a newly created quickscan in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url|max:255',
            'email' => 'required|email|max:255',
            'consent' => 'required'
        ]);

        $quickScan = new QuickScan();
        $quickScan->url = $request->url;
        $quickScan->email = $request->email;

        $quickScan->save();

        // Dispatch the job to start the scan
        QuickScanJob::dispatch($quickScan);

        return redirect()->route('quick-scan.show', $quickScan->id)
            ->with('success', 'Quickscan is running...');
    }
}
