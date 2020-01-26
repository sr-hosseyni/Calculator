<?php

namespace Calculator\Tests\Services\Validation\Validators;

use Calculator\Services\Validation\Validators\Required;
use Calculator\Tests\UnitTestCase;

/**
 * Description of RequiredTest
 *
 * @author sr_hosseini
 */
class RequiredTest extends UnitTestCase
{
    public function dataProvider(): array
    {
        return [
            [$value = 1, true],
            [$value = [1,2,3], true],
            [$value = '100', true],
            [$value = true, true],
            [$value = 2.5, true],
            [$value = null, false],
            [$value = '', false],
            [$value = 0, true],
            [$value = false, true],
            [$value = [], false],
        ];
    }
    
    /**
     * 
     * @param float $value
     * @param bool $expected
     * 
     * @dataProvider dataProvider
     */
    public function testCheck($value, bool $expected)
    {
        $validator = new Required();
        $this->assertEquals($expected, $validator->check($value));
    }
}
