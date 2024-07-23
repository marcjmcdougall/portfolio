<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\MultiSelect;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\BelongsTo;
use Whitecube\NovaFlexibleContent\Flexible;
use Laravel\Nova\Http\Requests\NovaRequest;

class Article extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Article>
     */
    public static $model = \App\Models\Article::class;

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
            ID::make()->sortable()->hideFromIndex(),
            Image::make('Featured Image')->disk('public')->nullable()->hideFromIndex(),
            Text::make('Title')->sortable(),
            Text::make('Byline')->hideFromIndex(),
            Slug::make('Slug'),
            Textarea::make('Excerpt')->hideFromIndex(),
            MultiSelect::make('Topic')
                ->options([
                    // 'case-studies' => 'Case Studies',
                    'conversion-rate-optimization' => 'Conversion-Rate Optimization',
                    'ux' => 'User Experience',
                    'ui' => 'User Interface',
                    'business' => 'Business',
                    'marketing' => 'Marketing',
                    'software-design' => 'Software Design',
                    'business' => 'Business',
                    'freelancing' => 'Freelancing',
                    'popular' => 'Popular',
                ])
                ->rules('required')
                ->displayUsingLabels(),
            Markdown::make('Content')->hideFromIndex(),
            DateTime::make('Created At')->sortable(),
            BelongsTo::make('User')
                ->default(function ($request) {
                    return $request->user()->id;
                })
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->hideFromIndex(),
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
