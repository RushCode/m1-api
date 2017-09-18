<?php

namespace Leocata\M1;

use Leocata\M1\Exceptions\ClientException;
use Leocata\M1\RequestHandlerInterface;

class HttpClientRequestHandler implements RequestHandlerInterface
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * HttpClientRequestHandler constructor.
     * @param LoopInterface $loop
     */
    public function __construct(LoopInterface $loop)
    {
        $this->client = new Client($loop);
    }

    /**
     * @param string $uri
     * @return PromiseInterface
     */
    public function get(string $uri): PromiseInterface
    {
        $request = $this->client->request('GET', $uri);
        return $this->processRequest($request);
    }

    /**
     * @param string $uri
     * @param array $options
     * @return PromiseInterface
     */
    public function post(string $uri, array $options): PromiseInterface
    {
        $headers = !empty($options['headers']) ? $options['headers'] : [];
        $request = $this->client->request('POST', $uri, $headers);
        return $this->processRequest($request, (!empty($options['body']) ? $options['body'] : null));
    }

    /**
     * @param Request $request
     * @param mixed $data
     * @return PromiseInterface
     */
    public function processRequest(Request $request, $data = null): PromiseInterface
    {
        $deferred = new Deferred();

        $receivedData = '';
        $request->on('response', function (Response $response) use ($deferred, &$receivedData) {
            $response->on('data', function ($chunk) use (&$receivedData) {
                $receivedData .= $chunk;
            });

            $response->on('end', function () use (&$receivedData, $deferred, $response) {
                try {
                    $endResponse = new TelegramResponse($receivedData, $response->getHeaders());
                    $deferred->resolve($endResponse);
                } catch (\Exception $e) {
                    // Capture any exceptions thrown from TelegramResponse and reject the response
                    $deferred->reject($e);
                }
            });
        });

        $request->on('error', function (\Exception $e) use ($deferred) {
            $deferred->reject(new ClientException($e->getMessage(), $e->getCode(), $e));
        });

        $request->end($data);

        return $deferred->promise();
    }
}
