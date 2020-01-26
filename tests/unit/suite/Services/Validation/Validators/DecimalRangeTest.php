<?php

namespace Calculator\Tests\Services\Validation\Validators;

use Calculator\Services\Validation\Validators\DecimalRange;
use Calculator\Tests\UnitTestCase;

/**
 * Description of DecimalRangeTest
 *
 * @author sr_hosseini
 */
class DecimalRangeTest extends UnitTestCase
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
            
            
            [$min = 5, $max = 6.5, $value = 4.5, false],
            [$min = 5, $max = 6.5, $value = 4.99, false],
            [$min = 5, $max = 6.5, $value = 5.0, true],
            [$min = 5, $max = 6.5, $value = 5.5, true],
            [$min = 5, $max = 6.5, $value = 6.0, true],
            [$min = 5, $max = 6.5, $value = 6.5, true],
            [$min = 5, $max = 6.5, $value = 6.51, false],
            [$min = 5, $max = 6.5, $value = 7.0, false],
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
        $validator = new DecimalRange($min, $max);
        $this->assertEquals($expected, $validator->check($value));
    }
}
