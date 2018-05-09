<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Force redirect to secure route
    |--------------------------------------------------------------------------
    |
    | If true, all routes which use middleware
    | 'Angecode\LaravelForceHttps\Middleware\LaravelForceHttpsMiddlewareRedirect'
    | will be redirected to https
    |
    */
    'always_force_https' => false,

    /*
    |--------------------------------------------------------------------------
    | Force redirect to secure route depending on chosen environment 'APP_ENV'
    |--------------------------------------------------------------------------
    |
    | It redirects only if current environment is in the array
    |
    */
    'https_if_env_equal' => ['sandbox', 'production'],
];
