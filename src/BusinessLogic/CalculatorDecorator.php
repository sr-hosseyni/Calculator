<?php

namespace Calculator\BusinessLogic;

/**
 * Description of CalculatorDecorator
 *
 * @author sr_hosseini
 */
abstract class CalculatorDecorator implements CalculatorInterface
{
    /**
     * @var CalculatorInterface
     */
    protected $calculator;

    public function __construct(CalculatorInterface $calculator)
    {
        $this->calculator = $calculator;
    }
}
