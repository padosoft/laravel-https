<?php

namespace Padosoft\Laravel\Https\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpsForceMiddleware
{
    /**
     * Handle an incoming request and redirect if not https.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->isSecureRequest($request)) {
            return $next($request);
        }

        if (config('laravel-https.always_force_https')) {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        if (\App::environment(config('laravel-https.https_if_env_equal'))) {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        return $next($request);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function isSecureRequest(Request $request)
    {
        $xForwardedProto = strtolower($request->header('X_FORWARDED_PROTO', ''));
        return ($request->secure() || $xForwardedProto=='https');
    }
}
