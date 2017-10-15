<?php

namespace leocata\M1\Tests\Methods\Callback;

use leocata\M1\HttpClientAuthorization;
use leocata\M1\Methods\Callback\Message;
use leocata\M1\Tests\Mock\MockApi;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    /**
     * @var MockApi
     */
    private $apiConn;

    public function testMessage()
    {
        $result = $this->apiConn->getApiCallbackMethod(
            '{
                  "method": "message",
                  "params": {
                    "id": "4586734956793456",
                    "sessionid": "g85yjprdiyjh5",
                    "orig": "123123",
                    "dest": [
                      "4645694586"
                    ],
                    "content": "string",
                    "type": "1",
                    "status": "1",
                    "time": 0,
                    "lifetime": 0,
                    "code": 0
                  }
            }
            ');

        $this->assertInstanceOf(Message::class, $result);
        $this->assertEquals('4586734956793456', $result->id);
        $this->assertEquals('string', $result->content);
        $this->assertEquals('g85yjprdiyjh5', $result->sessionid);
        $this->assertEquals('123123', $result->orig);
        $this->assertEquals(['4645694586'], $result->dest);
        $this->assertEquals('1', $result->status);
        $this->assertEquals(0, $result->time);
        $this->assertEquals(0, $result->lifetime);
        $this->assertEquals(0, $result->code);

    }

    /**
     * Prepares the environment before running a test.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->apiConn = new MockApi(new HttpClientAuthorization('', ''));
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        $this->apiConn = null;
        parent::tearDown();
    }
}
