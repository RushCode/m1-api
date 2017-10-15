<?php

namespace leocata\M1\Tests\Mock;

use leocata\M1\Abstracts\RequestMethods;
use leocata\M1\Api;

class MockApi extends Api
{
    public static function doCallback($name, \Closure $func)
    {
        parent::doCallback($name, $func);
    }

    public function getApiCallbackMethod(string $data)
    {
        return parent::getApiCallbackMethod($data);
    }

    public function sendApiRequest(RequestMethods $method)
    {
        return parent::sendApiRequest($method);
    }
}
