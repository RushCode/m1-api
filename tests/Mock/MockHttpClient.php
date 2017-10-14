<?php

namespace leocata\M1\Tests\Mock;

use leocata\M1\HttpClient;
use leocata\M1\HttpClientAuthorization;

class MockHttpClient extends HttpClient
{
    private $client;

    /**
     * MockHttpClient constructor.
     * @param HttpClientAuthorization $auth
     */
    public function __construct(HttpClientAuthorization $auth)
    {
        $this->client = parent::__construct($auth);
    }

    public function getResponseContent($request)
    {
        return parent::getResponseContent($request);
    }

}
