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

            Textarea::make('Messaging Evaluation', function () {
                    if (isset($this->info['openai_messaging_evaluation'])) {
                        return $this->info['openai_messaging_evaluation'] ?? 'No evaluation available';
                    }
                    return 'N/A';
                })->onlyOnDetail(),

            Text::make('H1 Evaluation', function () {
                    if (isset($this->info['openai_h1_rating'])) {
                        return $this->info['openai_h1_rating'] ?? 'No evaluation available';
                    }
                    return 'N/A';
                })->onlyOnDetail(),
                
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
