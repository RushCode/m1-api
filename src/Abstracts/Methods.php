<?php

namespace leocata\M1\Abstracts;

use leocata\M1\Exceptions\MissingMandatoryField;
use leocata\M1\Interfaces\MethodDefinitions;
use ReflectionClass;

/**
 * Class Methods
 * @package leocata\M1\Abstracts
 */
abstract class Methods implements MethodDefinitions
{
    private $mandatoryFields;

    public function __construct()
    {
        $this->mandatoryFields = $this->getMandatoryFields();
    }

    /**
     * Import data from json string
     * @param $data \stdClass
     * @return Methods
     */
    final public function import(\stdClass $data)
    {
        foreach ($data as $key => $value) {
            $this->load($key, $value);
        }

        return $this->validate();
    }

    private function load($key, $value)
    {
        if ($value !== null) {
            $this->$key = $value;
        } else {
            unset($this->$key);
        }
    }

    private function validate()
    {
        foreach ($this->mandatoryFields as $field) {
            if (!isset($this->$field)) {
                throw new MissingMandatoryField(sprintf(
                    'The field "%s" is mandatory and empty, please correct',
                    $field
                ));
            }
        }
        return $this;
    }

    /**
     * Export data
     * @return bool|Methods
     */
    final public function export()
    {
        foreach ($this as $key => $value) {
            $this->load($key, $value);
        }

        return $this->validate();
    }

    /**
     * Convert method name to api
     * @return string
     */
    final public function getMethodName(): string
    {
        return lcfirst((new ReflectionClass($this))->getShortName());
    }
}
