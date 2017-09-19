<?php

namespace leocata\M1\Interfaces;

use leocata\M1\Abstracts\Types;
use leocata\M1\Response;
use Psr\Log\LoggerInterface;

interface MethodDefinitions
{
    /**
     * Most of the methods will instantiate a Message object, this method can override the default behaviour
     *
     * @param Response|Response $data
     * @param LoggerInterface|null $logger
     * @return Types
     */
    public static function bindToObject(Response $data, LoggerInterface $logger): Types;

    /**
     * Will check and export all mandatory fields, will also add non-mandatory fields if they have any values
     *
     * @return array
     */
    public function export(): array;

    /**
     * Gets the name of all mandatory fields
     * @return array
     */
    public function getMandatoryFields(): array;
}
