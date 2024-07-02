<?php

namespace App\Nova;

use GeneaLabs\NovaFileUploadField\FileUpload;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Waynestate\Nova\CKEditor;

class GameItem extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\GameItem::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'description',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request): array
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make('Игра', 'gameForItem', GameForItem::class)
                ->showCreateRelationButton()
                ->searchable()
                ->required(),
            Text::make('Товар', 'title')->sortable()->required(),
            CKEditor::make('Описание', 'description')
                ->options(config('novaToolbar.toolbar'))
                ->hideFromIndex()
                ->nullable(),
            FileUpload::make("Изображение", "image")
                ->thumbnail(function ($image) {
                    return $image
                        ? asset('storage/'.$image)
                        : '';
                })
                ->prunable()
                ->nullable(),
            Currency::make('Цена', 'price')->currency('RUB')->required(),
            Number::make('Скидка', 'discount'),
            Text::make('Описание скидки', 'discount_description')->nullable(),
            Boolean::make('Скидка', 'is_discount'),
            Number::make('Количество', 'quantity')->nullable(),
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
