<?php

namespace Calculator\Services\Validation\Validators;

/**
 * Required validator
 *
 * @author sr_hosseini
 */
class Required implements ValidatorInterface
{
    
    public function check($value): bool
    {
        return $value !== null && $value !== '' && $value !== [];
    }

    public function getMessage($name): string
    {
        return sprintf('%s is requierd', $name);
    }

    /**
     * This validator must be called even when $key does not present in data
     * @return bool
     */
    public function restrictValidate(): bool
    {
        return true;
    }

    /**
     * 
     * @return \self
     */
    public static function getInstance(): self
    {
        return new self;
    }
}
