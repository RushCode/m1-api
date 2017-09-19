<?php

namespace leocata\M1;

use leocata\M1\Abstracts\Methods;
use leocata\M1\InternalFunctionality\DummyLogger;
use BodyConstructor;
use Psr\Log\LoggerInterface;
use React\Promise\PromiseInterface;

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
     * Stores the clientAuthorization
     * @var string
     */
    private $httpClientAuthorization;

    /**
     * Stores the socket API URL
     * @var string
     */
    private $socketUrl;

    /**
     * Stores the API URL
     * @var string
     */
    private $httpUrl;

    /**
     * Api constructor.
     *
     * @param HttpClientAuthorization $httpClientAuthorization
     * @param RequestHandlerInterface $handler
     * @param LoggerInterface $logger
     * @internal param string $username
     * @internal param string $password
     * @internal param string $username
     * @internal param string $password
     * @internal param string $botToken
     */
    public function __construct(
        HttpClientAuthorization $httpClientAuthorization,
        RequestHandlerInterface $handler,
        LoggerInterface $logger = null
    ) {

        $this->httpClientAuthorization = $httpClientAuthorization;

        if ($logger === null) {
            $logger = new DummyLogger();
        }
        $this->logger = $logger;

        $this->requestHandler = $handler;
        $this->bodyConstructor = new BodyConstructor();
        $this->socketUrl = 'wss://m1online.net';
        $this->httpUrl = 'https://m1online.net';
    }

    /**
     * Performs the request to the M1 servers
     *
     * @param Methods $method
     *
     * @return PromiseInterface
     * @throws \leocata\M1\Exceptions\MissingMandatoryField
     */
    public function performApiRequest(Methods $method): PromiseInterface
    {
        $this->logger->debug('Request for async API call, resetting internal values', [get_class($method)]);
        $this->resetObjectValues();
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
     * Builds up the URL with which we can work with
     *
     * All methods in the Bot API are case-insensitive.
     * All queries must be made using UTF-8.
     *
     * @see https://core.telegram.org/bots/api#making-requests
     *
     * @param TelegramMethods $call
     * @return string
     */
    protected function composeApiMethodUrl(TelegramMethods $call): string
    {
        $completeClassName = get_class($call);
        $this->methodName = substr($completeClassName, strrpos($completeClassName, '\\') + 1);
        $this->logger->info('About to perform API request', ['method' => $this->methodName]);

        return $this->apiUrl . $this->methodName;
    }

    /**
     * @param File $file
     *
     * @return PromiseInterface
     */
    public function downloadFile(File $file): PromiseInterface
    {
        $url = 'https://api.telegram.org/file/bot' . $this->botToken . '/' . $file->file_path;
        $this->logger->debug('About to perform request to begin downloading file');

        return $this->requestHandler->get($url)->then(
            function (TelegramResponse $rawData) {
                return new TelegramDocument($rawData);
            }
        );
    }
}
