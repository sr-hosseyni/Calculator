<?php

namespace Calculator\BusinessLogic;

use Calculator\Entities\InsurancePolicy;

/**
 * Description of CalculatorBuilder
 *
 * @author sr_hosseini
 */
final class CalculatorBuilder
{
    /**
     *
     * @var CalculatorInterface
     */
    private $calculator;
    
    /**
     * 
     * @param InsurancePolicy $policy
     */
    public function __construct(InsurancePolicy $policy)
    {
        $this->calculator = new Calculator($policy);
    }
    
    /**
     * 
     * @return \self
     */
    public function applyCommision(): self
    {
        $this->calculator = new CommissionDecorator($this->calculator);
        return $this;
    }
    /**
     * 
     * @return \self
     */
    public function applyTax(): self
    {
        $this->calculator = new TaxDecorator($this->calculator);
        return $this;
    }

    /**
     * 
     * @return \self
     */
    public function applyInstalments(): self
    {
        $this->calculator = new InstalmentDecorator($this->calculator);
        return $this;
    }

    /**
     * 
     * @return \self
     */
    public function applyTotalPrice(): self
    {
        $this->calculator = new TotalPriceDecorator($this->calculator);
        return $this;
    }

    /**
     * 
     * @return \self
     */
    public function applyRounding(): self
    {
        $this->calculator = new RoundingDecorator($this->calculator);
        return $this;
    }

    /**
     * 
     * @return \self
     */
    public function applyRoundingErrorFixer(): self
    {
        $this->calculator = new RoundingErrorFixerDecorator($this->calculator);
        return $this;
    }
    
    /**
     * 
     * @return CalculatorInterface
     */
    public function build(): CalculatorInterface
    {
        /**
         * @todo we need a implementation to control decorators sequence
         * e.g. TotalPriceDecorator must be call at the end and
         * InstalmentsDecorator must be called after tax and commission and ...
         */
        return $this->calculator;
    }
}
