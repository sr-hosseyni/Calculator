<?php

namespace Calculator\Entities;

/**
 * InsurancePolicy
 *
 * @author sr_hosseini
 */
class InsurancePolicy
{
    private $carValue;
    private $taxPercent;
    private $instalmentsNumber;
    private $localTime;
    
    public function getCarValue()
    {
        return $this->carValue;
    }

    public function getTaxPercent()
    {
        return $this->taxPercent;
    }

    public function getInstalmentsNumber()
    {
        return $this->instalmentsNumber;
    }

    public function setCarValue($carValue)
    {
        $this->carValue = $carValue;
        return $this;
    }

    public function setTaxPercent($taxPercent)
    {
        $this->taxPercent = $taxPercent;
        return $this;
    }

    public function setInstalmentsNumber($instalmentsNumber)
    {
        $this->instalmentsNumber = $instalmentsNumber;
        return $this;
    }
    
    public function getLocalTime()
    {
        return $this->localTime;
    }

    public function setLocalTime($localTime)
    {
        $this->localTime = $localTime;
        return $this;
    }

    /**
     * Get new instance of InsurancePolicy
     * @return \self
     */
    public static function getInstance(): self
    {
        return new self;
    }
}
