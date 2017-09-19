<?php

namespace leocata\M1\InternalFunctionality;

use leocata\M1\Abstracts\Methods;
use leocata\M1\InternalFunctionality\DummyLogger;
use Psr\Log\LoggerInterface;

class BodyConstructor
{
    /**
     * With this flag we'll know what type of request to send to M1
     *
     * 'application/x-www-form-urlencoded' is the "normal" one, which is simpler and quicker.
     * 'multipart/form-data' should be used only when you upload documents, photos, etc.
     *
     * @var string
     */
    public $formType = 'application/json';

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        if ($logger === null) {
            $logger = new DummyLogger();
        }
        $this->logger = $logger;
    }

    /**
     * Builds up the form elements to be sent to Telegram
     *
     * @param Methods $method
     * @return array
     */
    public function constructOptions(Methods $method): array
    {
        $body = http_build_query($method->export(), '', '&');

        return [
            'headers' => [
                'Content-Type' => $this->formType,
                'Content-Length' => strlen($body),
                'User-Agent' => 'M1 Bot API'
            ],
            'body' => $body
        ];
    }
}
