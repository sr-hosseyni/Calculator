<?php

namespace Calculator\Tests\Mock\Services\Validation\Validators;

use Calculator\Services\Validation\Validators\ValidatorInterface;

/**
 * Description of FooValidator
 *
 * @author sr_hosseini
 */
class FooValidator implements ValidatorInterface
{
    private $acceptableValues;

    public function __construct(array $acceptableValuesMap = [])
    {
        $this->acceptableValue = $acceptableValuesMap;
    }
    
    /**
     * Dummy check function
     * @param type $value
     * @return bool
     */
    public function check($value): bool
    {
        return in_array($value, $this->acceptableValue);
    }

    public function getMessage($name): string
    {
        return sprintf('provided value for %s is not valid!', $name);
    }

    public function restrictValidate(): bool
    {
        return false;
    }
}
