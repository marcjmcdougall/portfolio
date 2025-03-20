<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuickScan extends Model
{
    protected $fillable = [
        'url',
        'email',
        'status',
        'progress',
        'html_content',
        'title',
        'screenshot_path',
        'meta_description',
        'issues',
        'info',
        'score',
        'completed_at'
    ];

    protected $casts = [
        'issues' => 'array',
        'info' => 'array',
        'completed_at' => 'datetime',
    ];

    // Informs the front-end of updates
    // protected $dispatchesEvents = [
    //     'updated' => \App\Events\QuickScanUpdated::class,
    // ];

    /**
     * Add progress to the scan and manage status.
     *
     * @param int $progress The increase in progress
     * @return bool Whether the update was successful
     */
    public function addProgress($progress) {
        $currentStatus = $this->status;
        $currentProgress = $this->progress;
        
        $newProgress = $currentProgress + $progress;
        $newStatus = $currentStatus;

        // Prevent progress overflow.
        if ($newProgress > 100) $newProgress = 100;

        if (100 === $newProgress) {
            // Update the scan status if progress reaches 100%
            $newStatus = 'completed';
        }

        $updateData = [
            'progress' => $newProgress,
            'status' => $newStatus,
        ];

        return $this->update($updateData);
    }

    /**
     * Add one or more issues to the issues array
     *
     * @param mixed $issues Single issue or array of issues
     * @param array $additional Additional fields to update
     * @return bool Whether the update was successful
     */
    public function addIssues($issues, array $additional = [])
    {
        // Get current issues (or empty array if null)
        $currentIssues = $this->issues ?? [];
        
        // Handle single issue or array of issues
        if (!is_array($issues) || !isset($issues[0])) {
            // Single issue or associative array
            $issues = [$issues];
        }
        
        // Merge the issues
        $updatedIssues = array_merge($currentIssues, $issues);
        
        // Prepare update data
        $updateData = ['issues' => $updatedIssues];
        
        // Add any additional fields to update
        if (!empty($additional)) {
            $updateData = array_merge($updateData, $additional);
        }
        
        // Perform the update
        return $this->update($updateData);
    }

    /**
     * Set a key in the info array
     *
     * @param string $key The key to set
     * @param mixed $value The value to set
     * @param array $additional Additional fields to update
     * @return bool Whether the update was successful
     */
    public function setInfo($key, $value, array $additional = [])
    {
        // Get current info data (or empty array if null)
        $info = $this->info ?? [];
        
        // Set the key
        $info[$key] = $value;
        
        // Prepare update data
        $updateData = ['info' => $info];
        
        // Add any additional fields to update
        if (!empty($additional)) {
            $updateData = array_merge($updateData, $additional);
        }
        
        // Perform the update
        return $this->update($updateData);
    }
}
