<?php

namespace Calculator\BusinessLogic;

use Calculator\BusinessLogic\BasePriceStrategy\BasePriceStrategyFactory;
use Calculator\Entities\InsurancePolicy;

/**
 * Calculator service for insurance policy
 *
 * @author sr_hosseini
 */
class Calculator implements CalculatorInterface
{
    const KEY = 'base';
    
    public function calculate(InsurancePolicy $policy): array
    {
        $basePriceStrategy = BasePriceStrategyFactory
                ::getActiveStrategyByTime(new \DateTime($policy->getLocalTime()));
        
        $title = sprintf('Base premium (%d%%)', $basePriceStrategy->getApplyingPercentage());
        $basePrice = $basePriceStrategy->calculateBasePrice($policy);

        return [
            self::KEY => [
                'title' => $title,
                'value' => [$basePrice]
            ]
        ];
    }    
}
