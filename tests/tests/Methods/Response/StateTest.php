<?php

namespace leocata\M1\Methods\Response;

use PHPUnit\Framework\TestCase;

class StateTest extends TestCase
{
    /**
     * @expectedException \leocata\M1\Exceptions\MissingMandatoryField
     * @expectedExceptionMessage state
     */

    public function testMissingMandatoryExportField()
    {
        $setState = new State();
        $setState->export();
    }
}
