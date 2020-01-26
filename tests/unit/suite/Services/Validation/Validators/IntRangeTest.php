<?php

namespace Calculator\Tests\Services\Validation\Validators;

use Calculator\Services\Validation\Validators\IntRange;
use Calculator\Tests\UnitTestCase;

/**
 * Description of IntRangeTest
 *
 * @author sr_hosseini
 */
class IntRangeTest extends UnitTestCase
{
    public function rangeDataProvider(): array
    {
        return [
            [$min = 1, $max = 100, $value = 1, true],
            [$min = 1, $max = 100, $value = 100, true],
            [$min = 1, $max = 100, $value = 50, true],
            [$min = 1, $max = 100, $value = 0, false],
            [$min = 1, $max = 100, $value = 101, false],
            [$min = 1, $max = 100, $value = 100.01, false],
            [$min = 1, $max = 100, $value = -1, false],
            [$min = 1, $max = 100, $value = -10, false],
            [$min = 1, $max = 100, $value = 1000, false],
        ];
    }
    
    /**
     * 
     * @param float $min
     * @param float $max
     * @param float $value
     * @param bool $expected
     * 
     * @dataProvider rangeDataProvider
     */
    public function testCheck(float $min, float $max, float $value, bool $expected)
    {
        $validator = new IntRange($min, $max);
        $this->assertEquals($expected, $validator->check($value));
    }
}
