<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Log;

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
        'info->openai_messaging_evaluation',
        'info->performance_metrics',
        'info->html_size_kb',
        'info->image_count',
        'score',
        'completed_at'
    ];

    protected $casts = [
        'issues' => 'array',
        'info' => 'json',
        'completed_at' => 'datetime',
    ];

    /**
     * Set the URL and automatically extract and store the domain.
     *
     * @param string $value
     * @return void
     */
    public function setUrlAttribute($value)
    {
        $this->attributes['url'] = $value;

        // Extract root domain.
        $domain = $this->extractRootDomain($value);
        $this->attributes['domain'] = $domain;
    }
    
    /**
     * Extract the root domain from a URL.
     *
     * @param string $url
     * @return string
     */
    private function extractRootDomain($url)
    {
        // Remove protocol
        $domain = preg_replace('#^https?://#', '', $url);
        
        // Remove path (anything after the first slash)
        $domain = preg_replace('#/.*$#', '', $domain);
        
        // Parse the domain to extract just the root domain
        $parts = explode('.', $domain);
        $partsCount = count($parts);
        
        // Handle special cases like co.uk, com.au, etc.
        $secondLevelDomains = ['co.uk', 'com.au', 'co.nz', 'org.uk', 'net.au', 'co.za', 'org.au'];
        
        if ($partsCount > 2) {
            $potentialSLD = $parts[$partsCount - 2] . '.' . $parts[$partsCount - 1];
            
            if (in_array($potentialSLD, $secondLevelDomains)) {
                // For domains like example.co.uk, return example.co.uk
                if ($partsCount > 3) {
                    return $parts[$partsCount - 3] . '.' . $parts[$partsCount - 2] . '.' . $parts[$partsCount - 1];
                }
            } else {
                // For domains like subdomain.example.com, return example.com
                return $parts[$partsCount - 2] . '.' . $parts[$partsCount - 1];
            }
        }
        
        // Return as is for simple domains like example.com
        return $domain;
    }

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
        // Build the update data
        $updateData = ["info->{$key}" => $value];
        
        // Add any additional fields
        if ( ! empty($additional)) {
            $updateData = array_merge($updateData, $additional);
        }

        // Fetch a fresh copy of the info array (to avoid overwrites).
        $this->refresh();
        
        // Perform the atomic update
        return $this->update($updateData);
    }
}
