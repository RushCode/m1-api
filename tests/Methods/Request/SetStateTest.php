<?php

namespace leocata\M1\tests\Methods;

use leocata\M1\Methods\Request\SetState;
use PHPUnit\Framework\TestCase;

class SetStateTest extends TestCase
{

    /**
     * @expectedException \leocata\M1\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage state
     */

    public function testMissingMandatoryExportField()
    {
        $setState = new SetState();
        $setState->export();
    }

    public function testStates()
    {
        $setState = new SetState();
        $setState->online();
        $this->assertSame(1, $setState->state);
        $setState->offline();
        $this->assertSame(0, $setState->state);
        $setState->away();
        $this->assertSame(2, $setState->state);
        $setState->busy();
        $this->assertSame(3, $setState->state);
    }
}
