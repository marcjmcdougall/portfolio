<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class PodcastAppearance extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\PodcastAppearance>
     */
    public static $model = \App\Models\PodcastAppearance::class;

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
            Text::make('Episode Title')->sortable(),
            Text::make('Podcast Name')->sortable(),
            Image::make('Featured Image')->disk('public')->nullable()->hideFromIndex(),
            MultiSelect::make('Topic')
                ->options([
                    'conversion-rate-optimization' => 'Conversion-Rate Optimization',
                    'ui-design' => 'UI Design',
                    'consulting' => 'Consulting',
                    'landing-pages' => 'Landing Pages',
                    'software-development' => 'Software Development',
                    'wordpress' => 'WordPress',
                    'marketing' => 'Marketing',
                    'business' => 'Business',
                    'freelancing' => 'Freelancing',
                    'popular' => 'Popular',
                ])
                ->rules('required')
                ->displayUsingLabels(),
            Textarea::make('Excerpt')->sortable(),
            Text::make('Link')->sortable()->hideFromIndex(),
            DateTime::make('Created At')->sortable(),
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
