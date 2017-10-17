<?php

namespace leocata\M1;

use leocata\M1\Abstracts\CallbackMethods;
use leocata\M1\Abstracts\RequestMethods;
use leocata\M1\Exceptions\MethodNotFound;
use leocata\M1\Exceptions\MissingMandatoryField;
use leocata\M1\InternalFunctionality\DummyLogger;
use Psr\Log\LoggerInterface;

/**
 * Class Api.
 */
class Api
{
    private static $callbacks = [];
    protected $logger;
    private $client;

    /**
     * @param LoggerInterface         $logger
     * @param Authorization $auth
     */
    public function __construct(Authorization $auth, LoggerInterface $logger = null)
    {
        if ($logger === null) {
            $logger = new DummyLogger();
        }
        $this->logger = $logger;

        $this->client = new HttpClient($auth);
    }

    /**
     * @param $name
     * @param \Closure $func
     *
     * @throws \BadFunctionCallException
     */
    public static function doCallback($name, \Closure $func)
    {
        if (array_key_exists($name, self::$callbacks)) {
            if (!is_callable($func)) {
                throw new \BadFunctionCallException();
            }
            call_user_func($func);
        }
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
        self::$callbacks += ['after'.$method->getMethodName() => $method];

        return $method;
    }

    /**
     * Performs the request to the Api servers.
     *
     * @param RequestMethods $method
     *
     * @return RequestMethods
     */
    public function sendApiRequest(RequestMethods $method)
    {
        $response = $this->client->getResponseContent($method->getRequestString());
        if (!empty($response)) {
            $method->setResult($response);
        }

        return $method;
    }
}
