# Laravel Package to force https redirect.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/padosoft/laravel-https.svg?style=flat-square)](https://packagist.org/packages/padosoft/laravel-https)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Quality Score](https://img.shields.io/scrutinizer/g/padosoft/laravel-https.svg?style=flat-square)](https://scrutinizer-ci.com/g/padosoft/laravel-https)
[![Total Downloads](https://img.shields.io/packagist/dt/padosoft/laravel-https.svg?style=flat-square)](https://packagist.org/packages/padosoft/laravel-https)

This package provides a laravel middleware to force https redirect. 

Table of Contents
=================

   * [Laravel Package to force https redirect.](#laravel-package-to-force-https-redirect)
      * [Requires](#requires)
      * [Installation](#installation)
      * [USAGE](#usage)
      * [Change log](#change-log)
      * [Testing](#testing)
      * [Contributing](#contributing)
      * [Security](#security)
      * [Credits](#credits)
      * [About Padosoft](#about-padosoft)
      * [License](#license)

##Requires
  
- "php" : ">=5.6.0",
- laravel/framework": "~5.2"
  
## Installation

You can install the package via composer:
``` bash
$ composer require padosoft/laravel-https
```

### FOR LARAVEL 5.6+
No additional steps required because the service provider use new L5.5+ autodiscovery feature.

### FOR LARAVEL <=5.5
You must install this service provider.

``` php
// config/app.php
'provider' => [
    ...
    Padosoft\Laravel\Https\LaravelHttpsServiceProvider::class,
    ...
];
```

### publish config (optional)
Optionally publish the packages config file by running the following from your projects root folder:

```bash
    php artisan vendor:publish --tag=laravel-https
```

### register the middleware
Add the middleware to your routes or controller. See Usage.


## USAGE

### From Route File:

You can include the HttpsForce in a route groups or on individual routes.

### Route Group Example:

``` php
    Route::group(['middleware' => ['web', 'HttpsForce']], function () {
        Route::get('/', 'WelcomeController@welcome');
    });
```

### Individual Route Examples:

``` php
    Route::get('/', 'WelcomeController@welcome')->middleware('HttpsForce');
    Route::match(['post'], '/test', 'Testing\TestingController@runTest')->middleware('HttpsForce');
```

### From Controller File:

You can include the HttpsForce in the contructor of your controller file.

### Controller File Example:

``` php
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('HttpsForce');
    }
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email instead of using the issue tracker.

## Credits
- [Lorenzo Padovani](https://github.com/lopadova)
- [All Contributors](../../contributors)

## About Padosoft
Padosoft (https://www.padosoft.com) is a software house based in Florence, Italy. Specialized in E-commerce and web sites.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
