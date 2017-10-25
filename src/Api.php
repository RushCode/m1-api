<?php

namespace leocata\M1;

use leocata\M1\Abstracts\CallbackMethods;
use leocata\M1\Abstracts\RequestMethods;
use leocata\M1\Exceptions\MethodNotFound;
use leocata\M1\Exceptions\MissingMandatoryField;
use leocata\M1\InternalFunctionality\DummyLogger;
use leocata\M1\Methods\Request\ContactAccept;
use leocata\M1\Methods\Request\MessageDelivered;
use leocata\M1\Methods\Request\MessageTyped;
use leocata\M1\Methods\Request\SendMessage;
use Psr\Log\LoggerInterface;

/**
 * Class Api.
 */
class Api
{
    /**
     * @var DummyLogger|LoggerInterface
     */
    protected $logger;
    /**
     * @var
     */
    private $client;
    /**
     * @var
     */
    private $auth;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        if ($logger === null) {
            $logger = new DummyLogger();
        }
        $this->logger = $logger;
    }

    /**
     * @param string $data
     *
     * @throws MethodNotFound | MissingMandatoryField
     *
     * @return bool|CallbackMethods
     */
    public function getCallbackMethod(string $data)
    {
        $data = \GuzzleHttp\json_decode($data);
        if (empty($data->method)) {
            return false;
        }

        $class = '\leocata\M1\Methods\Callback\\'.ucfirst($data->method);

        if (!class_exists($class)) {
            throw new MethodNotFound(sprintf(
                'The method "%s" not found, please correct',
                $class
            ));
        }

        /** @var \leocata\M1\Abstracts\CallbackMethods $method */
        $method = new $class();
        $method->import($data->params ?? new \stdClass());

        return $method;
    }

    /**
     * Performs the request to the Api servers.
     *
     * @param RequestMethods $method
     *
     * @return RequestMethods
     */
    public function sendRequest(RequestMethods $method)
    {
        $this->client = new HttpClient($this->auth);
        $response = $this->client->getResponseContent($method->getRequestString());
        if (!empty($response)) {
            $method->setResult($response);
        }

        return $method;
    }

    /**
     * Quick send new message.
     *
     * @param $sessionId
     * @param $destination
     * @param $code
     * @param $type
     * @param $content
     * @return RequestMethods
     */
    public function sendMessage($sessionId, $destination, $code, $type, $content)
    {
        $message = new SendMessage();
        $message->sessionid = $sessionId;
        $message->dest = $destination;
        $message->code = $code;
        $message->code = $type;
        $message->code = $content;

        return $this->sendRequest($message);
    }

    /**
     * Quick send message delivery status.
     *
     * @param $sessionId
     * @param $messageId
     *
     * @return RequestMethods
     */
    public function messageDelivered($sessionId, $messageId)
    {
        $messDelivered = new MessageDelivered();
        $messDelivered->sessionid = $sessionId;
        $messDelivered->messageid = $messageId;

        return $this->sendRequest($messDelivered);
    }

    /**
     * Send message type indicator.
     *
     * @param $sessionId
     * @param $userId
     *
     * @return RequestMethods
     */
    public function messageTyped($sessionId, $userId)
    {
        $messageTyped = new MessageTyped();
        $messageTyped->sessionid = $sessionId;
        $messageTyped->userid = $userId;

        return $this->sendRequest($messageTyped);
    }

    /**
     * Send contact Accept.
     *
     * @param $userId
     * @param $message
     * @param $state
     *
     * @return RequestMethods
     */
    public function contactAccept($userId, $message, $state)
    {
        $contactAccept = new ContactAccept();
        $contactAccept->userid = $userId;
        $contactAccept->message = $message;
        $contactAccept->state = $state;

        return $this->sendRequest($contactAccept);
    }

    /**
     * @return Authorization
     */
    public function getAuth() : Authorization
    {
        return $this->auth;
    }

    /**
     * @param mixed Authorization
     */
    public function setAuth(Authorization $auth)
    {
        $this->auth = $auth;
    }
}
