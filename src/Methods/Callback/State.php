<?php

namespace leocata\M1\Methods\Callback;

use leocata\M1\Abstracts\CallbackMethods;

/**
 * Class State
 * Notification of user’s status modification
 * @package leocata\M1\Methods
 */
class State extends CallbackMethods
{
    /**
     * User identifier.
     * If client receive message with it’s own userid, he should pass into the indicated status.
     * (used to activate the status "away" for the parallel-registered clients)
     * @var string
     */
    public $userid;

    public $state;

    public $note;
}
