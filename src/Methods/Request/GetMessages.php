<?php

namespace leocata\M1\Methods\Request;

use leocata\M1\Abstracts\RequestMethods;

/**
 * Get list of messages
 * Class GetMessages.
 */
class GetMessages extends RequestMethods
{
    /**
     * Query of sessions with activity within specified time period.
     */
    const PERIOD_ALL_TIME = 0;
    const PERIOD_LAST_MONTH = 1;
    const PERIOD_LAST_WEEK = 2;
    const PERIOD_LAST_DAY = 3;

    /**
     * Message type.
     */
    const MESSAGE_TEXT = 0;
    const MESSAGE_FILE_LINK = 2;
    const MESSAGE_ADD_CONFERENCE = 3;
    const MESSAGE_DELETE_CONFERENCE = 4;
    const MESSAGE_CONTACT_LINK = 10;

    /**
     * Message status.
     */
    const MESSAGE_STATUS_INCOMING_NEW = 1;
    const MESSAGE_STATUS_INCOMING_OUTCOMING = 2;
    const MESSAGE_STATUS_OUTCOMING_UNREAD = 3;
    const MESSAGE_STATUS_OUTCOMING_OUTCOMING = 4;

    /**
     * Session identifier.
     *
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
     * @var int
     */
    public $period;

    /**
     * Timestamp with sampling (in milliseconds since 01.01.1970).
     *
     * @var int
     */
    public $since;

    /**
     * Number of entries in the sample. If "limit" is absent or equal to zero, entries
     * are chosen in timestamp’s ascending order(from " since" till now) Otherwise - from "since" in descending order.
     *
     * @var int
     */
    public $limit;

    /**
     * GetMessages constructor.
     */
    public function __construct()
    {
        if ($this->period && $this->since === null) {
            $this->since = strtotime('-24 hour');
        }
    }

    public function getMandatoryFields(): array
    {
        return [];
    }
}
