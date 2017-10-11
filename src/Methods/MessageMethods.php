<?php

namespace leocata\M1\Methods;

use leocata\M1\Abstracts\Methods;

class MessageMethods extends Methods
{

    /**
     * Query of sessions with activity within specified time period
     */
    const PERIOD_ALL_TIME = 0;
    const PERIOD_LAST_MONTH = 1;
    const PERIOD_LAST_WEEK = 2;
    const PERIOD_LAST_DAY = 3;

    /**
     * Message type
     */
    const MESSAGE_TYPE_TEXT = 0;
    const MESSAGE_FILE_LINK = 2;
    const MESSAGE_ADD_CONFERENCE = 3;
    const MESSAGE_DELETE_CONFERENCE = 4;
    const MESSAGE_CONTACT_LINK = 10;

    /**
     * Message status
     */
    const MESSAGE_STATUS_INCOMING_NEW = 1;
    const MESSAGE_STATUS_INCOMING_OUTCOMING = 2;
    const MESSAGE_STATUS_OUTCOMING_UNREAD = 3;
    const MESSAGE_STATUS_OUTCOMING_OUTCOMING = 4;

    public function getMandatoryFields(): array
    {
        return [];
    }
}
