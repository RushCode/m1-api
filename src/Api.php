<?php

namespace leocata\M1;

use leocata\M1\Abstracts\Methods;
use leocata\M1\InternalFunctionality\BodyConstructor;
use leocata\M1\InternalFunctionality\DummyLogger;
use Psr\Log\LoggerInterface;
use React\Promise\PromiseInterface;

/**
 * Class Api
 * @package leocata\M1
 */
class Api
{

    /**
     * @var RequestHandlerInterface
     */
    protected $requestHandler;

    /**
     * @var BodyConstructor
     */
    protected $bodyConstructor;

    /**
     * Contains an instance to a PSR-3 compatible logger
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var string
     */
    protected $methodName = '';

    /**
     * Stores the API URL
     * @var string
     */
    private $host;

    /**
     * Api constructor.
     *
     * @param string $host
     * @param array $clientAuthorization
     * @param RequestHandlerInterface $handler
     * @param LoggerInterface $logger
     */
    public function __construct(
        string $host,
        array $clientAuthorization,
        RequestHandlerInterface $handler,
        LoggerInterface $logger = null
    ) {

        if ($logger === null) {
            $logger = new DummyLogger();
        }
        $this->logger = $logger;

        $this->requestHandler = $handler;
        $this->bodyConstructor = new BodyConstructor($logger, $clientAuthorization);
        $this->host = $host;
    }

    /**
     * Performs the request to server
     * @param Methods $method
     * @return PromiseInterface
     * @throws \leocata\M1\Exceptions\MissingMandatoryField
     */
    public function performApiRequest(Methods $method): PromiseInterface
    {
        $this->logger->debug('Request for async API call, resetting internal values', [get_class($method)]);
        $option = $this->bodyConstructor->constructOptions($method);

        return $this->sendRequestToTelegram($method, $option)
            ->then(function (Response $response) use ($method) {
                return $method::bindToObject($response, $this->logger);
            }, function ($error) {
                $this->logger->error($error);
                throw $error;
            });
    }

    /**
     * Resets everything to the default values
     * @return Api
     */
    final protected function resetObjectValues(): Api
    {
        $this->bodyConstructor->formType = 'application/x-www-form-urlencoded';

        return $this;
    }

    /**
     * @param Methods $method
     * @param array $formData
     * @return PromiseInterface
     */
    protected function sendRequestToTelegram(Methods $method, array $formData): PromiseInterface
    {
        $this->logger->debug('About to perform async HTTP call to M1\'s API');

        return $this->requestHandler->post($this->composeApiMethodUrl($method), $formData);
    }

    /**
     * @param Methods $call
     * @return string
     */
    protected function composeApiMethodUrl(Methods $call): string
    {
        $completeClassName = get_class($call);
        $this->methodName = substr($completeClassName, strrpos($completeClassName, '\\') + 1);
        $this->logger->info('About to perform API request', ['method' => $this->methodName]);

        return $this->host . $this->methodName;
    }
}
