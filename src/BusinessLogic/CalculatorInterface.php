<?php

namespace Calculator\BusinessLogic;

use Calculator\Entities\InsurancePolicy;

/**
 *
 * @author sr_hosseini
 */
interface CalculatorInterface
{
    public function calculate(InsurancePolicy $policy): array;
}
