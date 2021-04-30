<?php

namespace App\Providers;

use App\Listeners\QueryListener;
use Illuminate\Database\Events\QueryExecuted;
use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\ExampleEvent::class => [
            \App\Listeners\ExampleListener::class,
        ],
        \App\Events\QueryEvent::class =>[
            \App\Listeners\QueryListener::class,
        ],
    ];

    public function register()
    {
        $events = app('events');
        $events->listen(QueryExecuted::class, QueryListener::class);
    }
}

