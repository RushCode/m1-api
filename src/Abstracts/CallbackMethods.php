<?php

namespace leocata\M1\Abstracts;

abstract class CallbackMethods
{
    /**
     * Import data from json string.
     *
     * @param $data \stdClass
     */
    final public function import(\stdClass $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    final public function getMethodName(): string
    {
        return ucfirst((new \ReflectionClass($this))->getShortName());
    }
}
