<?php

namespace leocata\M1\Methods\Request;

use leocata\M1\Abstracts\RequestMethods;

/**
 * Class SetState
 * Set user's state.
 */
class SetState extends RequestMethods
{
    const OFFLINE = 0;
    const ONLINE = 1;
    const AWAY = 2;
    const BUSY = 3;

    /**
     * State:
     * 0 "offline" offline
     * 1 "online" online
     * 2 "away" absent (can receive calls, but shan't receive messages)
     * 3 "busy" busy (can receive messages, but shan’t receive calls).
     *
     * @var int
     */
    public $state = -1;
    public $termid;
    public $note;

    /**
     * Set state online.
     */
    public function online()
    {
        $this->state = self::ONLINE;
    }

    /**
     * Set state offline.
     */
    public function offline()
    {
        $this->state = self::OFFLINE;
    }

    /**
     * Set state away.
     */
    public function away()
    {
        $this->state = self::AWAY;
    }

    /**
     * Set state busy.
     */
    public function busy()
    {
        $this->state = self::BUSY;
    }

    public function getMandatoryFields(): array
    {
        return ['state'];
    }
}
