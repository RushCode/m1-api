<?php

namespace leocata\M1\tests\Methods\Request;

use leocata\M1\Authorization;
use leocata\M1\Methods\Request\SendMessage;
use leocata\M1\Tests\Mock\MockApi;
use PHPUnit\Framework\TestCase;

class SendMessageTest extends TestCase
{
    /**
     * @var MockApi
     */
    private $apiConn;

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->apiConn = new MockApi();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->apiConn = null;
        parent::tearDown();
    }

    /**
     * @expectedException \leocata\M1\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage sessionid
     */
    public function testMissingMandatoryExportField()
    {
        $sendMessage = new SendMessage();
        $sendMessage->export();
    }
}
