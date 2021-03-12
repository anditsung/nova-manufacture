<?php

namespace Tsung\NovaManufacture\Nova;

use Tsung\NovaManufacture\Nova\Filters\Line as LineFilter;
use Tsung\NovaManufacture\Nova\Filters\Plan as PlanFilter;
use Tsung\NovaManufacture\Nova\Filters\Product as ProductFilter;
use App\Nova\Resource;
use App\Nova\User;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Number;
use OptimistDigital\MultiselectField\Multiselect;
use Tsung\NovaUserManagement\Traits\ResourceAuthorization;
use Tsung\NovaUserManagement\Traits\ResourceRedirectIndex;

class Schedule extends Resource
{
    use ResourceAuthorization,
        ResourceRedirectIndex;


    // https://ourcodeworld.com/articles/read/434/top-5-best-free-jquery-and-javascript-dynamic-gantt-charts-for-web-applications
    // https://developers.google.com/chart/interactive/docs/gallery/ganttchart
    // https://github.com/adzon/laravel-gantt
    // https://github.com/scopdrag/laravel-google-chart
    // https://towardsdatascience.com/create-javascript-gantt-chart-55ff8ec08886
    // http://taitems.github.io/jQuery.Gantt/
    // https://webdesign.tutsplus.com/tutorials/build-a-simple-gantt-chart-with-css-and-javascript--cms-33813

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \Tsung\NovaManufacture\Models\Schedule::class;

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

    public static $group = "Manufacture";

    public static $displayInNavigation = false;

    public static $globallySearchable = false;

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make(__('Plan'))
                ->rules('required')
                ->viewable(false),

            Number::make(__('Line'))
                ->rules('required'),

            DateTime::make(__('Start'))
                ->rules('required')
                ->format('DD/MM/Y, hh:ss A'),

            DateTime::make(__('Finish'))
                ->rules('required')
                ->format('DD/MM/Y, hh:ss A'),

            BelongsTo::make(__('Product'))
                ->rules('required')
                ->viewable(false),

            BelongsTo::make(__('Type'))
                ->rules('required')
                ->viewable(false)
                ->hideFromIndex(),

            BelongsTo::make(__('Surface'))
                ->rules('required')
                ->hideFromIndex()
                ->viewable(false),

            BelongsTo::make(__('Color'))
                ->rules('required')
                ->hideFromIndex()
                ->viewable(false),

            Multiselect::make(__('Sizes'))
                ->options([
                    'XXS',
                    'XS',
                    'S',
                    'M',
                    'L',
                    'XL',
                    'XXL',
                ])
                ->hideFromIndex(),

            Hidden::make('user_id')
                ->default($request->user()->id),

            DateTime::make(__('Created At'))
                ->format('DD MMMM Y, hh:mm:ss A')
                ->onlyOnDetail(),

            DateTime::make(__('Updated At'))
                ->format('DD MMMM Y, hh:mm:ss A')
                ->onlyOnDetail(),

            BelongsTo::make(__('Created By'), 'user', User::class)
                ->onlyOnDetail(),
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
        return [
            (new PlanFilter),
            (new LineFilter),
            (new ProductFilter),
        ];
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
