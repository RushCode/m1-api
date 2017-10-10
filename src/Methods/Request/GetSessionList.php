<?php

namespace leocata\M1\Methods;

use leocata\M1\Abstracts\Methods;

/**
 * Class GetSessionList
 * @package leocata\M1\Methods
 */

class GetSessionList extends Methods
{

    /**
     * Timestamp (in milliseconds since 01.01.1970)
     * Query of active sessions since the indicated time. If this parameter is absent, all sessions get out.
     * @var int
     */
    public $since;

    public function getMandatoryFields(): array
    {
        return [];
    }
}
