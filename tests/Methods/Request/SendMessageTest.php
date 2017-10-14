<?php

namespace leocata\M1\tests\Methods\Request;

use leocata\M1\Methods\Request\SendMessage;
use PHPUnit\Framework\TestCase;

class SendMessageTest extends TestCase
{
    /**
     * @expectedException \leocata\M1\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage sessionid
     */

    public function testMissingMandatoryExportField()
    {
        $sendMessage = new SendMessage();
        $sendMessage->export();
    }

    /**
     * @expectedException \leocata\M1\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage dest
     */

    public function testMissingMandatoryExportFieldDest()
    {
        $sendMessage = new SendMessage();
        $sendMessage->sessionid = 123123;
        $sendMessage->export();
    }

}
