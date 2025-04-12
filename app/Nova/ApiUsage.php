<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;

use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class ApiUsage extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ApiUsage>
     */
    public static $model = \App\Models\ApiUsage::class;

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
        'id', 'usage_date'
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
            
            Date::make('Usage Date')
                ->sortable()
                ->rules('required'),
                
            Number::make('Input Tokens')
                ->sortable()
                ->rules('required'),
                
            Number::make('Output Tokens')
                ->sortable()
                ->rules('required'),
                
            Number::make('Thought Tokens')
                ->sortable()
                ->rules('required'),
                
            Text::make('Total Tokens', function () {
                return number_format($this->input_tokens + $this->output_tokens + $this->thought_tokens);
            })->sortable(),

            Text::make('Cost', function () {
                return '$' . number_format($this->cost, 5);
            })->sortable(),
            
            // Text::make('Total Tokens', function () {
            //     return number_format($this->input_tokens + $this->output_tokens + $this->thought_tokens);
            // })->onlyOnDetail(),
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
        return [
            new Metrics\TotalTokensPerDay(),
            // new Metrics\DailyTokenTrend()
        ];
        
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
