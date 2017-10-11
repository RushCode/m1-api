<?php

namespace leocata\M1\Methods;

use leocata\M1\Abstracts\Methods;

class Contact extends Methods
{
    public $findContact;
    public $inviteContact;
    public $contactRequested;
    public $contactAccept;
    public $contactAccepted;
    public $contactReject;
    public $contactRejected;
    public $deleteContact;
    public $updateContact;
    public $getContacts;

    public function getMandatoryFields(): array
    {
        return [];
    }
}
