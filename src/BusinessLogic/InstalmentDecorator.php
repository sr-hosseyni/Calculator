<?php

namespace Calculator\BusinessLogic;

use Calculator\Entities\InsurancePolicy;

/**
 * Instalment Calculator Decorator
 *
 * @author sr_hosseini
 */
class InstalmentDecorator extends CalculatorDecorator
{
    public function calculate(InsurancePolicy $policy): array
    {
        $data = $this->calculator->calculate($policy);

        if ($policy->getInstalmentsNumber() > 1) {
            foreach ($data as $key => $assocArray) {
                $value = $assocArray['value'][0];
                $eachInstValue = $value / $policy->getInstalmentsNumber();
                $allInstallmentsValues = array_fill(0, $policy->getInstalmentsNumber(), $eachInstValue);
                $data[$key]['value'] = array_merge([$value], $allInstallmentsValues);
            }
        }

        return $data;
    }
}
