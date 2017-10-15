<?php

namespace leocata\M1\Methods\Request;

use leocata\M1\Abstracts\RequestMethods;

class GetUserInfo extends RequestMethods
{

    public $userid;

    public function getMandatoryFields(): array
    {
        return [];
    }

    public function getUserId()
    {
        return $this->getResult()->userid;
    }
}
