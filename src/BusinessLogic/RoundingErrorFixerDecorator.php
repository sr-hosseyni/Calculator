<?php

namespace Calculator\BusinessLogic;

use Calculator\Entities\InsurancePolicy;

/**
 * TotalPrice Decorator
 * Calculate Total price of installments and sum column
 *
 * @author sr_hosseini
 */
class RoundingErrorFixerDecorator extends CalculatorDecorator
{
    public function calculate(InsurancePolicy $policy): array
    {
        $data = $this->calculator->calculate($policy);
        
        if ($policy->getInstalmentsNumber() > 1) {
            foreach ($data as &$row) {
                /**
                 * Index[0] calculated value without considering instalments
                 * Index[1..n] calculated amount for each instalments
                 * So, Sum(Index[1..n]) must be equal with Index[0]
                 */
                $roundOffError = $row['value'][0] - array_sum(array_slice($row['value'], 1));

                /**
                 * Applying fixer at first instalment amount
                 */
                $row['value'][1] += $roundOffError;
            }
        }
        
        return $data;
    }

}
