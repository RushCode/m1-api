<?php

namespace leocata\M1\Methods\Response;

use leocata\M1\Methods\StateMethods;

/**
 * Class State
 * Notification of user’s status modification
 * @package leocata\M1\Methods
 */
class State extends StateMethods
{
    /**
     * User identifier.
     * If client receive message with it’s own userid, he should pass into the indicated status.
     * (used to activate the status "away" for the parallel-registered clients)
     * @var string
     */
    public $userid;

    /**
     *
     * @return array
     */
    public function getMandatoryFields(): array
    {
        $fields = array_merge(parent::getMandatoryFields(), ['userid']);

        return $fields;
    }
}
