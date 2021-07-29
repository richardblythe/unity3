<?php

namespace Unity3_Vendor\App\Providers;

use Unity3_Vendor\Illuminate\Support\Facades\Event;
use Unity3_Vendor\Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = ['Unity3_Vendor\\App\\Events\\Event' => ['Unity3_Vendor\\App\\Listeners\\EventListener']];
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        //
    }
}
