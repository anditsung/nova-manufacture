<?php

namespace Tsung\NovaManufacture;

use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class NovaManufacture extends Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     *
     * @return void
     */
    public function boot()
    {
        Nova::script('nova-manufacture', __DIR__.'/../dist/js/tool.js');
        Nova::style('nova-manufacture', __DIR__.'/../dist/css/tool.css');

        Nova::resources(config('novamanufacture.resources'));
    }

    /**
     * Build the view that renders the navigation links for the tool.
     *
     * @return \Illuminate\View\View
     */
    public function renderNavigation()
    {
        return view('nova-manufacture::navigation');
    }
}
