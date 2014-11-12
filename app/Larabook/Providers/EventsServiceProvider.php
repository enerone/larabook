<?php namespace Larabook\Providers;

use Illuminate\Support\ServiceProvider;


/**
 * Class EventsServiceProvider
 * @package Larabook\Providers
 * Register Larabook event listeners
 */
class EventsServiceProvider extends ServiceProvider{
    public function register()
    {
        $this->app['events']->listen('Larabook.*', 'Larabook\Handlers\EmailNotifier');
    }
}