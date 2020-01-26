<?php

namespace Calculator\BusinessLogic\BasePriceStrategy;

use Calculator\BusinessLogic\BasePriceStrategy\DefaultBasePriceStrategy;
use Calculator\BusinessLogic\BasePriceStrategy\FridayAfternoonBasePriceStrategy;
use DateTime;

/**
 * Description of BasePriceCalculator
 *
 * @author sr_hosseini
 */
class BasePriceStrategyFactory
{
    public static function getActiveStrategyByTime(DateTime $dateTime)
    {
        /**
         * $no will be equal with a 3 digits number that
         * first number is week day integer (5 for Friday)
         * second and third digits are Hour in 24 hours base
         * So 515 to 520 are our goal
         */
        $no = $dateTime->format('NH');
        if ($no > 515 && $no < 520) {
            return new FridayAfternoonBasePriceStrategy();
        }
        
        return new DefaultBasePriceStrategy();
    }
}
