<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Str;

class GenerateTableOfContents extends Action
{
    use InteractsWithQueue, Queueable;

    public $name = 'Generate Table of Contents';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $table_of_contents = [];
            $lines = explode("\n", $model->content);
            foreach ($lines as $line) {
                if (preg_match('/^(#{1,3})\s+(.+)$/', $line, $matches)) {
                    $text = $matches[2];
                    \Log::info('Match found on ' . $text);
                    $slug = '#heading-' . Str::slug($text);  // This prefix can be found in /app/models/Article.php
                    $table_of_contents[$slug] = $text;
                }
            }
            $model->table_of_contents = $table_of_contents;
            $model->save();
        }

        return Action::message('Table of Contents generated successfully!');
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [];
    }
}
