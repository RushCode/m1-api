<?php

namespace Leocata\M1\Methods;

use Leocata\M1\Abstracts\Methods;

/**
 * Class SendMessage
 * @package Leocata\M1\Methods
 */
class SendMessage extends Methods
{
    /**
     * Session identifier.
     * @var string
     */
    public $sessionId;

    /**
     * List of the message recipients IDs.
     * @var array
     */
    public $dest = [];

    /**
     * Message content.
     * @var string
     */
    public $content;

    /**
     * Message type.
     * @var integer
     */
    public $type;

    /**
     * Stamp. Mark the important message.
     * @var boolean
     */
    public $code;

    /**
     * Message lifetime in seconds (for the self-removed messages).
     * @var integer
     */
    public $lifetime;

    /**
     * Gets the name of all mandatory fields
     * @return array
     */
    public function getMandatoryFields(): array
    {
        return [
            'sessionid',
            'dest',
            'content',
            'type',
        ];
    }
}
