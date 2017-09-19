<?php

namespace leocata\M1\InternalFunctionality;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;
use leocata\M1\Methods\SendMessage;
use leocata\M1\Api;

/**
 * Extends monolog to handle
 */
class MonologHandler extends AbstractProcessingHandler
{
    /**
     * Holds Api object
     * @var Api
     */
    private $mobApi = null;

    /**
     * Which chat id the message should be sent to
     * @var int
     */
    private $sessionid = 0;

    /**
     * MonologHandler constructor.
     *
     * @param Api $mobApi
     * @param string $sessionid
     * @param int $level
     * @param bool $bubble
     */
    public function __construct(Api $mobApi, string $sessionid, $level = Logger::DEBUG, $bubble = true)
    {
        $this->mobApi = $mobApi;
        $this->sessionid = $sessionid;
        parent::__construct($level, $bubble);
    }

    /**
     * @param array $record
     * @return $this
     */
    public function write(array $record)
    {
        $sendMessage = new SendMessage();
        $sendMessage->content = $record['formatted'];
        $sendMessage->sessionid = $this->sessionid;

        $this->mobApi->performApiRequest($sendMessage);
        return $this;
    }
}
