<?php

namespace Calculator\BusinessLogic;

use Calculator\Entities\InsurancePolicy;

/**
 * TotalPrice Decorator
 * Calculate Total price of installments and sum column
 *
 * @author sr_hosseini
 */
class TotalPriceDecorator extends CalculatorDecorator
{
    const KEY = 'total';

    public function calculate(InsurancePolicy $policy): array
    {
        $data = $this->calculator->calculate($policy);
        
        $title = 'Total cost';
        
        $total = [];
        foreach ($data as $assocArray) {
            foreach ($assocArray['value'] as $index => $value) {
                $total[$index] = isset($total[$index]) ? $total[$index] + $value : $value;
            }
        }
        
        $data[self::KEY] = [
            'title' => $title,
            'value' => array_values($total)
        ];
        
        return $data;
    }

}
