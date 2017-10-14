<?php

namespace leocata\M1\Methods\Request;

use leocata\M1\Abstracts\RequestMethods;

class ContactAccept extends RequestMethods
{
    public $userid;
    public $message;
    public $state;
    public $note;

    public function getMandatoryFields(): array
    {
        return ['userid', 'state'];
    }
}
