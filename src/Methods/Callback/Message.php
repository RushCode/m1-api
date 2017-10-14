<?php

namespace leocata\M1\Methods\Callback;

use leocata\M1\Abstracts\CallbackMethods;

class Message extends CallbackMethods
{
    /**
     * Session identifier
     * @var string
     */
    public $sessionid;

    /**
     * Message identifier
     * @var string
     */
    public $id;

    /**
     * Message sender identifier
     * @var string
     */
    public $orig;

    /**
     * Identifier list of all message recipients
     * @var array
     */
    public $dest;

    /**
     * Message content
     * @var string
     */
    public $content;

    /**
     * Message type:
     *  - 1 text
     *  - 2 link to the file
     *  - 3 add to conference
     *  - 4 delete from conference
     *  - 10 contact link
     * @var integer
     */
    public $type;

    /**
     * Message status:
     *  - 1 incoming new
     *  - 2 incoming outcoming
     *  - 3 outcoming unread
     *  - 4 outcoming outcoming
     * @var integer
     */
    public $status;

    /**
     * Timestamp of message creation (in milliseconds since 01.01.1970)
     * @var integer
     */
    public $time;

    /**
     * Timestamp of message delivery (in milliseconds since 01.01.1970)
     * @var integer
     */
    public $delivered;

    /**
     * Stamp
     * @var integer
     */
    public $code;

    /**
     * Message lifetime in seconds (for the self-removed messages)
     * @var integer
     */
    public $lifetime;
}
