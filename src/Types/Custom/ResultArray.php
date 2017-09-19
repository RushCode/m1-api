<?php

namespace leocata\M1\Types\Custom;

/**
 * Mainly used if we have no clue what type of (new?) object the API is returning us
 */
class ResultArray extends TraversableCustomType
{
    /**
     * @var array
     */
    public $data = '';

    /**
     * ResultArray constructor.
     * @param array $result
     * @internal param array $data
     */
    public function __construct(array $result)
    {
        $this->data = $result;
    }

    /**
     * Return the data
     * @return string
     */
    public function __toString()
    {
        return json_encode($this->data);
    }
}
