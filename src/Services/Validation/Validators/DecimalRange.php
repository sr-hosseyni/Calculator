<?php

namespace Calculator\Services\Validation\Validators;

/**
 * Description of Range
 *
 * @author sr_hosseini
 */
class DecimalRange implements ValidatorInterface
{
    /**
     *
     * @var float
     */
    private $min;
    
    /**
     *
     * @var float
     */
    private $max;

    public function __construct(float $min, float $max)
    {
        $this->min = $min;
        $this->max = $max;
    }
    
    public function check($value): bool
    {
        return $value >= $this->min && $value <= $this->max;
    }

    public function getMessage($name): string
    {
        return sprintf('%s must be between %f and %f', $name, $this->min, $this->max);
    }

    /**
     * Do not call check method while there is no value provided in validating data
     * @return bool
     */
    public function restrictValidate(): bool
    {
        return false;
    }
    
    /**
     * 
     * @param float $min
     * @param float $max
     * @return \Calculator\Services\Validation\Validators\Range
     */
    public static function getInstance(float $min, float $max): DecimalRange
    {
        return new self($min, $max);
    }
}
