<?php

namespace Leocata\M1\Abstracts;

use Leocata\M1\Interfaces\MethodDefinitions;
use Leocata\M1\Response;
use Leocata\M1\Types\Message;

abstract class Methods implements MethodDefinitions
{
    /**
     * @var Response
     */
    protected $response;

    /**
     * Most of the methods will return a Message object on success, so set that as the default.
     *
     * This function may however be overwritten if the method uses another object, there are many examples of this, so
     * just check out the rest of the code. A good place to start is GetUserProfilePhotos or LeaveChat
     *
     * @param Response|Response $data
     * @return Types
     * @internal param LoggerInterface $logger
     */
    public static function bindToObject(Response $data): Types
    {
        return new Message($data->getResult());
    }

    /**
     * Exports the class to an array in order to send it to the Telegram servers without extra fields that we don't need
     *
     * @return array
     * @throws MissingMandatoryField
     */
    final public function export(): array
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

        return $finalArray;
    }
}
