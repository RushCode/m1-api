<?php

namespace leocata\M1;

use leocata\M1\Abstracts\Methods;
use leocata\M1\Exceptions\JsonParserException;

/**
 * Class Api
 * @package leocata\M1
 */
class Api
{

    const RESPONSE_METHOD_ALIAS = 'Response';
    const REQUEST_METHOD_ALIAS = 'Request';

    private $method;
    private $methodType;
    private $params;

    /**
     * @param $data
     * @return string
     */
    public function getApiResponse(string $data)
    {
        $this->methodType = self::RESPONSE_METHOD_ALIAS;
        $data = $this->parseData($data);
        $this->method = $this->setMethod($data->method);
        $this->method->import($data->params);

        return $this->method;
    }

    private function parseData($data)
    {
        $data = $this->methodType === self::REQUEST_METHOD_ALIAS ? json_encode($data) : json_decode($data);

        if ($data === null) {
            throw new JsonParserException(sprintf(
                'JSON decode error: "%s"',
                json_last_error_msg()
            ));
        }

        return $data;
    }

    /**
     * @param $data Methods
     * @return string
     */
    public function sendApiRequest(Methods $data): string
    {
        $this->methodType = self::REQUEST_METHOD_ALIAS;
        $this->method = $data;
        $this->params = $data->export();

        return $this->parseData(['method' => $this->method->getMethodName(), 'params' => $this->method]);
    }

    /**
     * @return Methods
     */
    public function getMethod(): Methods
    {
        return $this->method;
    }

    /**
     * @param $method
     * @return Methods
     * @internal param string $alias
     */
    public function setMethod($method): Methods
    {
        class_alias('\leocata\M1\Methods\\' . $this->methodType . '\\' . $method, $method);

        return new $method();
    }
}
