<?php

namespace Reedware\LaravelSMS\Tests\Twilio;

use Reedware\LaravelSMS\Twilio\TwilioTransport;
use Twilio\Http\Client as HttpClient;
use Twilio\Rest\Client;

class SMSTwilioTransportTest extends TestCase
{
    public function testGetTwilioTransportWithConfiguredClient()
    {
        $this->app['config']->set('sms.default', 'twilio');
        $this->app['config']->set('sms.providers.twilio.account_sid', 'example');
        $this->app['config']->set('sms.providers.twilio.auth_token', 'example');

        $transport = $this->app['sms']->getTransport();
        $this->assertInstanceOf(TwilioTransport::class, $transport);

        $twilio = $transport->twilio();
        $this->assertInstanceOf(Client::class, $twilio);

        $this->assertInstanceOf(HttpClient::class, $client = $twilio->getHttpClient());
    }
}