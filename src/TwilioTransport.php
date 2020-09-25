<?php

namespace Reedware\LaravelSMS\Twilio;

use Reedware\LaravelSMS\Contracts\Message as MessageContract;
use Reedware\LaravelSMS\Transport\Transport;
use Twilio\Rest\Client;

class TwilioTransport extends Transport
{
    /**
     * The twilio sdk.
     *
     * @var \Twilio\Rest\Client
     */
    protected $twilio;

    /**
     * Creates a new twilio transport instance.
     *
     * @param  \Twilio\Rest\Client  $twilio
     *
     * @return $this
     */
    public function __construct(Client $twilio)
    {
        $this->twilio = $twilio;
    }

    /**
     * Sends the given message; returns the number of recipients who were accepted for delivery.
     *
     * @param  \Reedware\LaravelSMS\Contracts\Message  $message
     * @param  string[]                                $failedRecipients
     *
     * @return int
     */
    public function send(MessageContract $message, &$failedRecipients = null)
    {
        foreach ($message->getTo() as $to) {
            $this->twilio->messages->create($to['number'], [
                'from' => $message->getFrom()[0]['number'],
                'body' => $message->getBody()
            ]);
        }
    }

    /**
     * Returns the twilio sdk.
     *
     * @return \Twilio\Rest\Client
     */
    public function twilio()
    {
        return $this->twilio;
    }
}