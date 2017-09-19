<?php

namespace leocata\M1\Types\Custom;

use leocata\M1\Abstracts\Types;

class UnsuccessfulRequest extends Types
{
    /**
     * Per definition, this will always be false, as this is an unsuccessful request
     * @var bool
     */
    public $ok = false;

    /**
     * An Integer ‘error_code’ field is returned, but its contents are subject to change in the future
     * @var int
     */
    public $error_code = 0;

    /**
     * In case of an unsuccessful request, ‘ok’ equals false and the error is explained in the ‘description’
     * @var string
     */
    public $description = '';

    /**
     * Some errors may also have an optional field ‘parameters’ of the type ResponseParameters, which can help to
     * automatically handle the error
     *
     * @see ResponseParameters
     * @var ResponseParameters
     */
    public $parameters = null;

    /**
     * @param string $key
     * @param array $data
     * @return Types
     */
    protected function mapSubObjects(string $key, array $data): Types
    {
        switch ($key) {
            case 'parameters':
                return new ResponseParameters($data, $this->logger);
        }

        return parent::mapSubObjects($key, $data);
    }
}