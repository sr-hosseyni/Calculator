<?php

namespace Calculator\Services\Validation\Validators;

/**
 * Description of ValidatorInterface
 *
 * @author sr_hosseini
 */
interface ValidatorInterface
{
    /**
     * Check $value is observe validator condition
     * @param type $value
     * @return bool
     */
    public function check($value): bool;
    
    /**
     * Get error messages while check method return false
     * @param type $name
     * @return string
     */
    public function getMessage($name): string;
    
    /**
     * Indicate should call check method always, even when data is not exists with null value or not
     * @return bool
     */
    public function restrictValidate(): bool;
}
