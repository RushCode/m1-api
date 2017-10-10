<?php

namespace leocata\M1\Types;

use leocata\M1\Abstracts\Types;

/**
 * Class Session
 * @package leocata\M1\Types
 */
class Session extends Types
{

    /**
     * Session identifier
     * @var string
     */
    public $id;

    /**
     * Session name
     * @var string
     */
    public $name;

    /**
     * Timestamp of session’s start (in milliseconds since 01.01.1970)
     * @var integer
     */
    public $created;

    /**
     * Timestamp of session parameters modification (in milliseconds since 01.01.1970)
     * @var integer
     */
    public $updated;

    /**
     * List of User IDs - current session's members
     * @var array
     */
    public $parties;

    /**
     * User status concerning this session
     * @var integer
     */
    public $status;

    /**
     * List of Admin IDs
     * @var array
     */
    public $admins;

    /**
     * total number of messages in chat
     * @var integer
     */
    public $count;
    /**
     * Number of new messages
     * @var integer
     */
    public $new;

    /**
     * Timestamp of last message (in milliseconds since 01.01.1970)
     * @var integer
     */
    public $time;
}
