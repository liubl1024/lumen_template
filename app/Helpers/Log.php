<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log as Logger;

/**
 * Class Log
 *
 * @package \App\Helpers
 */

/**
 * @method static \Psr\Log\LoggerInterface channel(string $channel = null)
 * @method static \Psr\Log\LoggerInterface stack(array $channels, string $channel = null)
 * @method static void alert(string $message, array $context = [])
 * @method static void critical(string $message, array $context = [])
 * @method static void debug(string $message, array $context = [])
 * @method static void emergency(string $message, array $context = [])
 * @method static void error(string $message, array $context = [])
 * @method static void info(string $message, array $context = [])
 * @method static void log($level, string $message, array $context = [])
 * @method static void notice(string $message, array $context = [])
 * @method static void warning(string $message, array $context = [])
 * @method static void write(string $level, string $message, array $context = [])
 * @method static void listen(\Closure $callback)
 *
 * @see \Illuminate\Log\Logger
 */
class Log
{
    public static function __callStatic($name, $arguments)
    {
        $requestId = app('request')->headers->get('X-Request-ID')??"";

        if(isset($arguments[0])){
            $arguments[0] = $requestId ." ". $arguments[0];
        }else{
            $arguments[0] = $requestId ." ";
        }

        return call_user_func([Logger::class,$name], ...$arguments);
    }
}
