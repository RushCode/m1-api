<?php

namespace leocata\M1\Tests\Mock;

use leocata\M1\HttpClient;

class MockHttpClient extends HttpClient
{
    public function getResponseContent($request)
    {
        return parent::getResponseContent($request);
    }
}
