<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\JSON;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\URL;

use Illuminate\Support\Facades\Storage;

class QuickScan extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\QuickScan>
     */
    public static $model = \App\Models\QuickScan::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            
            Text::make('URL', 'url')
                ->sortable()
                ->rules('required', 'url'),
                
            Text::make('Name', 'name')
                ->sortable()
                ->rules('required', 'max:255'),
                
            Email::make('Email', 'email')
                ->sortable()
                ->rules('required', 'email', 'max:255'),
                
            Badge::make('Status', 'status')
                ->map([
                    'queued' => 'info',
                    'processing' => 'warning',
                    'completed' => 'success',
                    'failed' => 'danger',
                ])
                ->sortable(),
                
            Number::make('Progress', 'progress')
                ->sortable()
                ->min(0)
                ->max(100),

            URL::make('View Report', function(){
                    return config('app.url') . route('quick-scan.show', [
                        'quickScan' => $this->id,
                        'domain' => $this->domain,
                    ], false);
                }),
                
            Code::make('HTML Content', 'html_content')
                ->language('html')
                ->onlyOnDetail(),

            Image::make('Screenshot', 'screenshot_path')
                ->disk('public') // Specify the disk where images are stored
                ->thumbnail(function ($value, $disk) {
                    return $value ? Storage::disk($disk)->url($value) : null;
                })
                ->preview(function ($value, $disk) {
                    return $value ? Storage::disk($disk)->url($value) : null;
                })
                ->onlyOnDetail()
                ->maxWidth(600) // Set maximum width for detail view
                ->prunable(false) // Don't allow deletion via Nova
                ->readonly(), // Don't allow uploading via Nova
                
            Text::make('Title', 'title')
                ->sortable()
                ->hideFromIndex(),

            Code::make('Messaging Evaluation', function () {
                    if (isset($this->info['openai_messaging_evaluation'])) {
                        $data = $this->info['openai_messaging_evaluation'];
                        
                        // If it's already an array, encode it to a JSON string for display
                        if (is_array($data)) {
                            return json_encode($data, JSON_PRETTY_PRINT);
                        }
                        
                        return $data;
                    }
                    return '{}';
                })
                ->json()
                ->onlyOnDetail(),

            Code::make('Performance Metrics', function () {
                    if (isset($this->info['performance_metrics'])) {
                        $data = $this->info['performance_metrics'];
                        
                        // If it's already an array, encode it to a JSON string for display
                        if (is_array($data)) {
                            return json_encode($data, JSON_PRETTY_PRINT);
                        }
                        
                        return $data;
                    }
                    return '{}';
                })
                ->json()
                ->onlyOnDetail(),
                
            Textarea::make('Meta Description', 'meta_description')
                ->rows(3)
                ->hideFromIndex(),

            Code::make('Issues', 'issues')
                ->json()
                ->onlyOnDetail(),

            Code::make('Info', 'info')
                ->json()
                ->onlyOnDetail(),
                
            Number::make('Score', 'score')
                ->sortable()
                ->min(0)
                ->max(100)
                ->step(0.1),
                
            DateTime::make('Completed At', 'completed_at')
                ->sortable()
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
