<?php

namespace Calculator\BusinessLogic;

use Calculator\Entities\InsurancePolicy;

/**
 * Description of Commission
 *
 * @author sr_hosseini
 */
class CommissionDecorator extends CalculatorDecorator
{
    const KEY = 'commission';
    private const COMMISSION_PERCENTAGE = 17;


    public function calculate(InsurancePolicy $policy): array
    {
        $data = $this->calculator->calculate($policy);
        
        $title = sprintf('Commission (%d%%)', self::COMMISSION_PERCENTAGE);
        
        /**
         * Commission will be COMMISSION_PERCENTAGE * basePrice
         */
        $basePrice = $data[Calculator::KEY]['value'][0];
        $value = $basePrice * self::COMMISSION_PERCENTAGE / 100;

        $data[self::KEY] = [
            'title' => $title,
            'value' => [$value]
        ];
        
        return $data;
    }
}
