<?php

namespace leocata\M1;

use GuzzleHttp\Client;

class HttpClient
{
    private $client;
    private $auth;
    private $request;

    /**
     * HttpClient constructor.
     *
     * @param Authorization $auth
     */
    public function __construct(Authorization $auth)
    {
        $this->client = new Client(['base_uri' => 'https://m1online.net']);
        $this->auth = $auth;
    }

    /**
     * @param $request
     *
     * @return mixed|null
     */
    public function getResponseContent($request)
    {
        $this->request = $request;
        $response = $this->response()->getBody()->getContents();

        return !empty($response) ? \GuzzleHttp\json_decode($response) : null;
    }

    /**
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    private function response()
    {
        return $this->client->request('POST', '/', [
            'headers' => [
                    'Content-Type' => 'application/json',
                ] +
                $this->auth->getBasicAuth(),
            'body' => $this->request,
        ]);
    }
}
