<?php

namespace Calculator\BusinessLogic;

use Calculator\Entities\InsurancePolicy;

/**
 * TotalPrice Decorator
 * Calculate Total price of installments and sum column
 *
 * @author sr_hosseini
 */
class RoundingDecorator extends CalculatorDecorator
{
    public function calculate(InsurancePolicy $policy): array
    {
        $data = $this->calculator->calculate($policy);
        
        foreach ($data as &$assocArray) {
            foreach ($assocArray['value'] as &$value) {
                $value = round($value, 2);
            }
        }
        
        return $data;
    }

}
