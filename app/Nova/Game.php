<?php

namespace App\Nova;

use GeneaLabs\NovaFileUploadField\FileUpload;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Waynestate\Nova\CKEditor;

//use Whitecube\NovaFlexibleContent\Flexible;

class Game extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Game::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'slug',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Name')->sortable(),
            Text::make('Slug')->sortable(),
            CKEditor::make('Description')
                ->options(config('novaToolbar.toolbar'))
                ->hideFromIndex(),
            FileUpload::make("Image", "poster")
                ->thumbnail(function ($image) {
                    return $image
                        ? asset('storage/'.$image)
                        : '';
                })
                ->prunable(),
            FileUpload::make("Banner", "banner")
                ->thumbnail(function ($image) {
                    return $image
                        ? asset('storage/'.$image)
                        : '';
                })
                ->prunable()
                ->hideFromIndex(),
            Text::make('Seo description', 'seo_description')->hideFromIndex(),
            Text::make('Seo keywords','seo_keywords')->hideFromIndex(),
            Boolean::make('Показать', 'is_active'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
