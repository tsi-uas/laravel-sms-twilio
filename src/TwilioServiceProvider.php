<?php

namespace Reedware\LaravelSMS\Twilio;

use Illuminate\Support\ServiceProvider;
use Reedware\LaravelSMS\Events\ManagerBooted;
use Twilio\Http\CurlClient;
use Twilio\Rest\Client;

class TwilioServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app['events']->listen(ManagerBooted::class, function($event) {
            $event->manager->extend('twilio', function($app, $name, $config) {
                return $this->createTwilioTransport($config);
            });
        });
    }

    /**
     * Creates and returns the twilio transport implementation.
     *
     * @param  array  $config
     *
     * @return \Reedware\LaravelSMS\Twilio\TwilioTransport
     */
    protected function createTwilioTransport($config)
    {
        return new TwilioTransport(
            new Client(
                $config['username'] ?? $config['account_sid'],
                $config['password'] ?? $config['auth_token'],
                $config['account_sid'] ?? null,
                $config['region'] ?? null,
                new CurlClient([
                    CURLOPT_SSL_VERIFYHOST => $config['verify'] ?? false,
                    CURLOPT_SSL_VERIFYPEER => $config['verify'] ?? false
                ])
            )
        );
    }
}
