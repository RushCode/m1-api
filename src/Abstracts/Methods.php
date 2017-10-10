<?php

namespace leocata\M1\Abstracts;

use leocata\M1\Exceptions\MissingMandatoryField;
use leocata\M1\Interfaces\MethodDefinitions;

/**
 * Class Methods
 * @package leocata\M1\Abstracts
 */
abstract class Methods implements MethodDefinitions
{

    /**
     * Import data from json string
     *
     * @param $data \stdClass
     * @return bool
     */
    final public function import(\stdClass $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }

        return $this->isValid();
    }

    /**
     * Validate properties
     * @return bool
     */
    final protected function isValid(): bool
    {
        $fields = $this->getMandatoryFields();
        foreach ($this as $key => $value) {
            if ($this->$key === null && in_array($key, $fields, true)) {
                throw new MissingMandatoryField(sprintf(
                    'The field "%s" is mandatory and empty, please correct',
                    $key
                ));
            }
        }

        return true;
    }

    /**
     * Export data
     * @return bool|Methods
     * @internal param Methods $data
     * @internal param Methods $method
     */
    final public function export()
    {

        foreach ($this as $key => $value) {
            $this->$key = $value;
        }

        return $this->isValid() ? $this : false;
    }

    /**
     * Convert method name to api
     * @return string
     */
    final public function getMethodName(): string
    {
        return lcfirst((new \ReflectionClass($this))->getShortName());
    }
}
