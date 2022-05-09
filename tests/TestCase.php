<?php

namespace Halo\LaravelSMS\Tests\Twilio;

use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Returns the package providers for the application.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Halo\LaravelSMS\SMSServiceProvider::class,
            \Halo\LaravelSMS\Twilio\TwilioServiceProvider::class
        ];
    }
}