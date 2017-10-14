<?php

namespace leocata\M1\Methods\Request;

use leocata\M1\Abstracts\RequestMethods;

class GetContacts extends RequestMethods
{

    const STATUS_UNAUTHORIZED = 0;
    const STATUS_AUTHORIZATION_REQUEST = 1;
    const STATUS_WAITING_FOR_AUTHORIZATION = 2;
    const STATUS_BLOCKED = 3;
    const STATUS_VALID = 4;
    const STATUS_VALID_ON_THE_WHITE_LIST = 5;
    const STATUS_IN_FAVOURITES = 6;

    public function getMandatoryFields(): array
    {
        return [];
    }

    public function getStatusOfUsers()
    {
        $result = $this->getResult();
        $userid = [];
        if (!empty($result)) {
            foreach ($result as $contact) {
                $userid[$contact->status][] = $contact->userid;
            }

            return $userid;
        }

        return null;
    }
}
