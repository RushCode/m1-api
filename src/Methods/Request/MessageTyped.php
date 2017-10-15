<?php

namespace leocata\M1\Methods\Request;

use leocata\M1\Abstracts\RequestMethods;

class MessageTyped extends RequestMethods
{

    public $sessionid;
    public $userid;

    public function getMandatoryFields(): array
    {
        return ['sessionid', 'userid'];
    }
}
