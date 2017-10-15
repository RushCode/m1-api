<?php

namespace leocata\M1\Methods\Request;

use leocata\M1\Abstracts\RequestMethods;

class MessageDelivered extends RequestMethods
{
    public $messageid;
    public $sessionid;

    public function getMandatoryFields(): array
    {
        return ['messageid', 'sessionid'];
    }
}
