<?php

namespace leocata\M1\Abstracts;

use leocata\M1\Types\Custom\ResultArray;

abstract class Types
{

    public function __construct(array $data = null)
    {
        if ($data !== null) {
            $this->populateObject($data);
        }
    }

    final protected function populateObject(array $data = []): Types
    {
        foreach ($data as $key => $value) {
            $candidateKey = null;
            if (is_array($value)) {
                $candidateKey = $this->mapSubObjects($key, $value);
            }

            if (!empty($candidateKey)) {
                if ($candidateKey instanceof CustomType) {
                    $this->$key = $candidateKey->data;
                } else {
                    $this->$key = $candidateKey;
                }
            } else {
                $this->$key = $value;
            }
        }

        return $this;
    }

    /**
     *
     * @param string $key
     * @param array $data
     * @return Types
     */
    protected function mapSubObjects(string $key, array $data): Types
    {
        if (!isset($this->$key)) {
            $this->logger->error(sprintf(
                'The key "%s" does not exist in the class! Maybe a recent Telegram Bot API update? In any way, please ' .
                'submit an issue (bug report) at %s with this complete log line',
                $key,
                'https://github.com/unreal4u/telegram-api/issues'
            ), [
                'object' => get_class($this),
                'data' => $data,
            ]);
        }

        return new ResultArray($data);
    }
}
