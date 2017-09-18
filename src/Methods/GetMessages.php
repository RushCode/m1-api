<?php

namespace Leocata\M1\Methods;

/**
 * Class GetMessages
 * @package Leocata\M1\Methods
 */
class GetMessages
{

    /**
     * Session identifier.
     * @var string
     */
    public $sessionId;

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

    public function getMandatoryFields(): array
    {
        return [
            'sessionId'
        ];
    }

}
