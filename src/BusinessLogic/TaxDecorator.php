<?php

namespace Calculator\BusinessLogic;

use Calculator\Entities\InsurancePolicy;

/**
 * Tax Decorator
 *
 * @author sr_hosseini
 */
class TaxDecorator extends CalculatorDecorator
{

    public function calculate(InsurancePolicy $policy): array
    {
        $data = $this->calculator->calculate($policy);
        $title = sprintf('Tax (%d%%)', $policy->getTaxPercent());
        
        /**
         * Tax will be given taxPercentage * basePrice
         */
        $basePrice = $data[Calculator::KEY]['value'][0];
        $value = $basePrice * $policy->getTaxPercent() / 100;
        
        $data['tax'] = [
            'title' => $title,
            'value' => [$value]
        ];

        return $data;
    }
}
