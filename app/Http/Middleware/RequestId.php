<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

/**
 * Class RequestId
 *
 * @package \App\Http\Middleware
 */
class RequestId
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle(\Illuminate\Http\Request $request, Closure $next)
    {
        $uuid = $request->headers->get('X-Request-ID');
        if (is_null($uuid)) {
            $uuid = Str::upper(Str::uuid());
            $request->headers->set('X-Request-ID', $uuid);
        }

        $realIp = $request->headers->get('X-Forwarded-For')?? $request->ip();
        //记录所有请求的 参数
        Log::info("{$uuid} {$realIp} {$request->method()} {$request->getProtocolVersion()} {$request->getRequestUri()}  {$request->userAgent()}", $request->all());

        $response = $next($request);

        $responseStr = sprintf('HTTP/%s %s %s',$response->getProtocolVersion(), $response->getStatusCode(),$response->getContent());
        Log::info("{$uuid} {$responseStr}");
        return $response;
    }
}
