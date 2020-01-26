<?php

namespace Calculator\BusinessLogic\BasePriceStrategy;

use Calculator\Entities\InsurancePolicy;

/**
 *
 * @author sr_hosseini
 */
interface StrategyInterface
{
    public function calculateBasePrice(InsurancePolicy $policy): float;
    public function getApplyingPercentage(): int;
}
