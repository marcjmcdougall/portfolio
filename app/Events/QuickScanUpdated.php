<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use \App\Models\QuickScan;

class QuickScanUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $quickScan;

    public function __construct(QuickScan $quickScan)
    {
        $this->quickScan = $quickScan;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('quick-scan.' . $this->quickScan->id);
    }

    public function broadcastWith()
    {
        $data = [
            'id' => $this->quickScan->id,
            'progress' => $this->quickScan->progress,
            'status' => $this->quickScan->status,
            'updated_at' => $this->quickScan->updated_at->toIso8601String()
        ];

        // Add screenshot if available
        if (!empty($this->quickScan->screenshot_path)) {
            $data['screenshot_path'] = $this->quickScan->screenshot_path;
        }

        // // Add messaging results if available
        // if (isset($this->quickScan->info['openai_messaging_evaluation'])) {
        //     $data['categories'] = $this->prepareEvaluationSections($this->quickScan);
        // }
        
        // // Add performance metrics if available
        // if ($metrics = $this->getPerformanceMetrics($this->quickScan)) {
        //     $data['performanceMetrics'] = $metrics;
        // }
        
        return $data;
    }
}
