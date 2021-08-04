<?php

namespace App\Listeners;

use DateTime;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;

/**
 * Class QueryListener
 *
 * @package \App\Listeners
 */
class QueryListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param QueryExecuted $event
     *
     * @return void
     */
    public function handle(QueryExecuted $event)
    {
        try{
            if (env('APP_DEBUG') == true) {
                $sql = str_replace("?", "'%s'", $event->sql);
                foreach ($event->bindings as $i => $binding) {
                    if ($binding instanceof DateTime) {
                        $event->bindings[$i] = $binding->format("Y-m-d H:i:s.u");
                    } else {
                        if (is_string($binding)) {
                            $event->bindings[$i] = $binding;
                        }
                    }
                }
                $log = vsprintf($sql, $event->bindings);
                $this->initLog();
                $log = "{$log}; RunTime: {$event->time} ms";
                Log::channel("sql")->debug($log);
            }
        }catch (\Exception $exception){

        }

    }

    public function initLog()
    {
        $logger = app()->make(Logger::class)->channel("sql");
        $requestId = request()->headers->get('X-Request-ID');
        $logger->pushProcessor(function ($record) use ($requestId) {
            $record['message'] = $requestId . " ".  $record['message'];
            return $record;
        });
    }
}

