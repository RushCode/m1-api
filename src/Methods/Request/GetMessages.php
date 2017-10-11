<?php

namespace leocata\M1\Methods\Request;

use leocata\M1\Interfaces\MethodRequest;
use leocata\M1\Methods\MessageMethods;

/**
 * Get list of messages
 * Class GetMessages
 * @package leocata\M1\Methods
 */
class GetMessages extends MessageMethods implements MethodRequest
{

    /**
     * Session identifier.
     * @var string
     */
    public $sessionid;

    /**
     * Time period.
     *
     * Query of sessions with activity within specified time period:
     *  - 0 for all time
     *  - 1 for the past year
     *  - 2 for the last month
     *  - 3 for the last week
     *  - 4 for the last twenty-four hours
     *
     * @var integer
     */
    public $period;

    /**
     * Timestamp with sampling (in milliseconds since 01.01.1970).
     * @var integer
     */
    public $since;

    /**
     * Number of entries in the sample. If "limit" is absent or equal to zero, entries
     * are chosen in timestamp’s ascending order(from " since" till now) Otherwise - from "since" in descending order.
     * @var integer
     */
    public $limit;

    /**
     * GetMessages constructor.
     */
    public function __construct()
    {
        if ($this->period && $this->since === null) {
            $this->since = strtotime('-1 hour');
        }
        parent::__construct();
    }

    public function getMandatoryFields(): array
    {
        return [];
    }

    public function result()
    {
        return [];
    }
}
