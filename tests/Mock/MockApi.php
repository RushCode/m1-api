<?php

namespace leocata\M1\Tests\Mock;

use leocata\M1\Api;

class MockApi extends Api
{
    public function getCallbackMethod(string $data)
    {
        return parent::getCallbackMethod($data);
    }
}
