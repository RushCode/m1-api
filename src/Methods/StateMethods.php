<?php

namespace leocata\M1\Methods;

use leocata\M1\Abstracts\Methods;

abstract class StateMethods extends Methods
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
     * 3 "busy" busy (can receive messages, but shan’t receive calls)
     * @var integer
     */
    public $state;

    /**
     * User message.
     * @var string
     */
    public $note;

    /**
     * Set state online
     */
    public function online()
    {
        $this->state = self::ONLINE;
    }

    /**
     * Set state offline
     */
    public function offline()
    {
        $this->state = self::OFFLINE;
    }

    /**
     * Set state away
     */
    public function away()
    {
        $this->state = self::AWAY;
    }

    /**
     * Set state busy
     */
    public function busy()
    {
        $this->state = self::BUSY;
    }

    /**
     * Set Mandatory Fields for all methods
     * @return array
     */
    public function getMandatoryFields(): array
    {
        return ['state'];
    }
}
