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

    /**
     * A message may contain one or more subobjects, map them always in this function
     *
     * @param string $key
     * @param array $data
     * @return Types
     */
    protected function mapSubObjects(string $key, array $data): Types
    {
        switch ($key) {
            case 'from':
            case 'forward_from':
            case 'new_chat_member':
            case 'left_chat_member':
                return new User($data, $this->logger);
            case 'new_chat_members':
                return new UserArray($data, $this->logger);
            case 'photo':
            case 'new_chat_photo':
                return new PhotoSizeArray($data, $this->logger);
            case 'chat':
            case 'forward_from_chat':
                return new Chat($data, $this->logger);
            case 'reply_to_message':
            case 'pinned_message':
                return new Message($data, $this->logger);
            case 'entities':
                return new MessageEntityArray($data, $this->logger);
            case 'audio':
                return new Audio($data, $this->logger);
            case 'document':
                return new Document($data, $this->logger);
            case 'game':
                return new Game($data, $this->logger);
            case 'sticker':
                return new Sticker($data, $this->logger);
            case 'video':
                return new Video($data, $this->logger);
            case 'voice':
                return new Voice($data, $this->logger);
            case 'video_note':
                return new VideoNote($data, $this->logger);
            case 'contact':
                return new Contact($data, $this->logger);
            case 'location':
                return new Location($data, $this->logger);
            case 'venue':
                return new Venue($data, $this->logger);
            case 'invoice':
                return new Invoice($data, $this->logger);
            case 'successful_payment':
                return new SuccessfulPayment($data, $this->logger);
        }
        // Return always null if none of the objects above matches
        return parent::mapSubObjects($key, $data);
    }
}
