<?php

namespace leocata\M1\Abstracts;

use leocata\M1\Exceptions\MissingMandatoryField;
use leocata\M1\Interfaces\MethodDefinitions;

abstract class RequestMethods implements MethodDefinitions
{

    private $result;

    /**
     * @return mixed
     */
    final public function getResult()
    {
        return $this->result;
    }

    final public function setResult($data)
    {
        if (is_array($data->result)) {
            foreach ($data->result as $key => $value) {
                $this->result[$key] = $value;
            }
        } else {
            $this->result = $data;
        }
    }

    /**
     * @return string
     */
    final public function getRequestString()
    {
        $request = ['method' => $this->getMethodName()];

        if (!empty($params = $this->export())) {
            $request += ['params' => $params];
        }

        return \GuzzleHttp\json_encode($request);
    }

    /**
     * @return array
     * @throws MissingMandatoryField
     */
    final public function export()
    {
        $finalArray = [];
        $mandatoryFields = $this->getMandatoryFields();

        $cleanObject = new $this();
        foreach ($cleanObject as $fieldId => $value) {
            if ($this->$fieldId === $cleanObject->$fieldId) {
                if (in_array($fieldId, $mandatoryFields, true)) {
                    throw new MissingMandatoryField(sprintf(
                        'The field "%s" is mandatory and empty, please correct',
                        $fieldId
                    ));
                }
            } else {
                $finalArray[$fieldId] = $this->$fieldId;
            }
        }

        return empty($finalArray) ? null : $finalArray;
    }

    final public function getMethodName(): string
    {
        return lcfirst((new \ReflectionClass($this))->getShortName());
    }
}
