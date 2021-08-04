<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $requestId = $request->headers->get('X-Request-ID');
        if (is_null($requestId)) {
            $requestId = Str::upper(Str::uuid());
            $request->headers->set('X-Request-ID', $requestId);
        }

        $this->initLog($requestId);

        $realIp = $request->headers->get('X-Forwarded-For')?? $request->ip();

        //记录所有请求的 参数
        Log::info("{$realIp} {$request->method()} {$request->getProtocolVersion()} {$request->getRequestUri()}  {$request->userAgent()}", $request->all());

        $response = $next($request);

        $responseContent = "";
        // json 响应才记录输出信息
        if($response instanceof  JsonResponse){
            $responseContent = $response->getContent();
        }else{
            $responseContent = " Content-Type: ". $response->headers->get("Content-Type");
        }

        $responseStr = sprintf('HTTP/%s %s %s',$response->getProtocolVersion(), $response->getStatusCode(),$responseContent);
        Log::info("{$responseStr}");
        return $response;
    }

    public function initLog($requestId)
    {
        $logger = app()->make('log');
        $logger->pushProcessor(function ($record) use ($requestId) {
            $record['message'] = $requestId . " ".  $record['message'];
            return $record;
        });
    }
}
