<?php

namespace Padosoft\Laravel\Https\Test;

class LaravelHttpsTest extends TestBaseOrchestra
{
    protected $notifier;

    public function setUp()
    {
        parent::setUp();

        $this->createRoutes();
    }

    public function createRoutes()
    {
        \Route::middleware('HttpsForce')->any('/', function () {
            return 'OK';
        })->name('myUri');

        \Route::middleware('HttpsForce')->any('/a', function () {
            return 'secure url';
        }, ['https' => true])->name('mySecureUri');
    }

    /**
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    public function getPackageProviders($app)
    {
        return [\Padosoft\Laravel\Https\LaravelHttpsServiceProvider::class];
    }

    /** @test */
    public function test_secure_url()
    {
        config(['laravel-https.always_force_https' => true]);
        $response = $this->get(secure_url('/a'));
        $response->assertStatus(200);
    }

    /** @test */
    public function testalways_force_httpsFalse()
    {
        config(['laravel-https.always_force_https' => false]);
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test */
    public function testalways_force_httpsTrue()
    {
        config(['laravel-https.always_force_https' => true]);
        $response = $this->get('/');
        $response->assertStatus(301);
        $response->assertRedirect(secure_url('/'));
    }

    /** @test */
    public function testEnviromentNotInArray()
    {
        config(['laravel-https.always_force_https' => false]);
        config(['laravel-https.https_if_env_equal' => ['sandbox', 'production']]);
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    /** @test */
    public function testEnviromentIsInArray()
    {
        config(['laravel-https.always_force_https' => false]);
        config(['laravel-https.https_if_env_equal' => ['sandbox', 'testing']]);
        $response = $this->get('/');
        $response->assertStatus(301);
        $response->assertRedirect(secure_url('/'));
    }

}
