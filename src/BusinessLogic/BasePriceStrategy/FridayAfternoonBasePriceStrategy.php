<?php

namespace Calculator\BusinessLogic\BasePriceStrategy;

use Calculator\Entities\InsurancePolicy;

/**
 * Description of BasePriceCalculatorStrategy
 *
 * @author sr_hosseini
 */
class FridayAfternoonBasePriceStrategy implements StrategyInterface
{
    private const BASE_PRICE_PERCENTAGE = 13;

    /**
     * Base price is equal with BASE_PRICE_PERCENTAGE * carValue
     * @return float
     */
    public function calculateBasePrice(InsurancePolicy $policy): float
    {
        return $policy->getCarValue() * self::BASE_PRICE_PERCENTAGE / 100;
    }

    public function getApplyingPercentage(): int
    {
        return self::BASE_PRICE_PERCENTAGE;
    }
}
