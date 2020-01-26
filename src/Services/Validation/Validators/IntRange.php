<?php

namespace Calculator\Services\Validation\Validators;

/**
 * Description of Range
 *
 * @author sr_hosseini
 */
class IntRange implements ValidatorInterface
{
    private $min;
    private $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }
    
    public function check($value): bool
    {
        return $value >= $this->min && $value <= $this->max;
    }

    public static function getInstance(int $min, int $max): IntRange
    {
        return new self($min, $max);
    }

    public function getMessage($name): string
    {
        return sprintf('%s must be between %d and %d', $name, $this->min, $this->max);
    }

    /**
     * Do not call check method while there is no value provided in validating data
     * @return bool
     */
    public function restrictValidate(): bool
    {
        return false;
    }
}
