<?php

namespace leocata\M1\Methods\Request;

use leocata\M1\Abstracts\RequestMethods;

/**
 * Class SendMessage
 * Sending message from the client to the server.
 */
class SendMessage extends RequestMethods
{
    /**
     * Session identifier.
     *
     * @var string
     */
    public $sessionid;

    /**
     * List of the message recipients IDs.
     *
     * @var array
     */
    public $dest;

    /**
     * Message content.
     *
     * @var string
     */
    public $content;

    /**
     * Message type.
     *
     * @var int
     */
    public $type;

    /**
     * Stamp. Mark the important message.
     *
     * @var bool
     */
    public $code;

    /**
     * Message lifetime in seconds (for the self-removed messages).
     *
     * @var int
     */
    public $lifetime;

    /**
     * Gets the name of all mandatory fields.
     *
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
