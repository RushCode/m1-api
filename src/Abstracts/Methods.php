<?php

namespace leocata\M1\Abstracts;

use leocata\M1\Exceptions\MissingMandatoryField;
use leocata\M1\Interfaces\MethodDefinitions;
use leocata\M1\Response;
use leocata\M1\Types\Message;
use Psr\Log\LoggerInterface;

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
     * @param LoggerInterface $logger
     * @return Types
     * @internal param LoggerInterface $logger
     */
    public static function bindToObject(Response $data, LoggerInterface $logger): Types
    {
        return new Message($data->getResult(), $logger);
    }

    /**
     * Before making the actual request this method will be called
     *
     * It must be used to json_encode stuff, or do other changes in the internal class representation _before_ sending
     * it to the Telegram servers
     *
     * @return Methods
     */
    public function performSpecialConditions(): Methods
    {
        if (!empty($this->reply_markup)) {
            $this->reply_markup = json_encode($this->formatReplyMarkup($this->reply_markup));
        }
        return $this;
    }

    /**
     * Exports the class to an array in order to send it to servers without extra fields that we don't need
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
