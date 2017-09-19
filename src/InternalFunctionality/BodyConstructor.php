<?php

namespace leocata\M1\InternalFunctionality;

use leocata\M1\Abstracts\Methods;
use Psr\Log\LoggerInterface;

/**
 * Class BodyConstructor
 * @package leocata\M1\InternalFunctionality
 */
class BodyConstructor
{

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var array
     */
    private $clientAuthorization;

    /**
     * BodyConstructor constructor.
     * @param LoggerInterface $logger
     * @param array $clientAuthorization
     */
    public function __construct(LoggerInterface $logger, array $clientAuthorization)
    {
        $this->logger = $logger;
        $this->clientAuthorization = $clientAuthorization;
    }

    /**
     * Builds up the method to be sent to http-server
     * @param Methods $method
     * @return array
     */
    public function constructOptions(Methods $method): array
    {
        $body = http_build_query($method->export(), '', '&');

        return [
            'headers' => [
                'Content-Type' => 'application/json',
                'Content-Length' => strlen($body),
            ] + $this->clientAuthorization,
            'body' => $body
        ];
    }
}
