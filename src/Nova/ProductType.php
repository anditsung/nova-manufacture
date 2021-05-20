<?php

namespace Tsung\NovaManufacture\Nova;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Tsung\NovaUserManagement\Traits\ResourceAuthorization;
use Tsung\NovaUserManagement\Traits\ResourceRedirectIndex;

class ProductType extends Resource
{
    use ResourceRedirectIndex,
        ResourceAuthorization;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Tsung\NovaManufacture\Models\ProductType::class;

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
        'name'
    ];

    public static $group = "Manufacture";

    public static $globallySearchable = false;

    public static $displayInNavigation = false;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            Text::make(__('Name'))
                ->exceptOnForms(),

            BelongsTo::make(__('Product'), 'product', Product::class)
//                ->searchable()
                ->viewable(false),

            BelongsTo::make(__('Size'), 'size', Size::class)
//                ->searchable()
                ->viewable(false),

            BelongsTo::make(__('Color'), 'color', Color::class)
//                ->searchable()
                ->viewable(false),

            BelongsTo::make(__('Surface'), 'surface', Surface::class)
//                ->searchable()
                ->viewable(false),

            BelongsTo::make(__('Weight'), 'weight', Weight::class)
//                ->searchable()
                ->viewable(false),
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

    public static function uriKey()
    {
        return 'manufacture-' . parent::uriKey();
    }
}
