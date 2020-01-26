<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Calculator\Services\Validation;

use Calculator\Services\Validation\Validators\ValidatorInterface;

/**
 * Description of BaseValidation
 *
 * @author sr_hosseini
 */
abstract class BaseValidation implements ValidationInterface
{
    /**
     *
     * @var ValidatorInterface[][]
     */
    protected $validators = [];
    
    /**
     * @var array|string[]
     */
    protected $messages = [];
    
    public function __construct()
    {
        $this->initialize();
    }
    
    /**
     * Initialize validation object with validators
     */
    public abstract function initialize();

    /**
     * Validate given $data
     * @param array $data
     * @return array
     */
    public function validateData(array $data): bool
    {
        $isValid = true;
        foreach ($this->validators as $key => $validators) {
            $isValid &= $this->validateKey($key, $validators, $data);
        }
        
        return (bool)$isValid;
    }
    
    /**
     * Check given a key in data with all validators of the key
     * @param string $key
     * @param ValidatorInterface[] $validators
     * @param array $data
     * @return bool
     */
    protected function validateKey(string $key, array $validators, array $data): bool
    {
        $isValid = true;
        foreach ($validators as $validator) {
            if (isset($data[$key]) || $validator->restrictValidate()) {
                $isValid &= $this->checkValidator($key, $validator, $data);
            }
        }
        
        return (bool)$isValid;
    }
    
    /**
     * Check a validator with given data
     * @param ValidationInterface $validator
     * @param array $data
     * @return bool
     */
    protected function checkValidator(string $key, ValidatorInterface $validator, array $data): bool
    {
        if (!$validator->check($data[$key] ?? null)) {
            $this->messages[$key][] = $validator->getMessage($key);
            return false;
        }
        
        return true;
    }
    
    /**
     * Add a validator for specific key in this validation
     * @param string $key
     * @param \Calculator\Services\Validation\ValidatorInterface $validator
     */
    public function add(string $key, ValidatorInterface $validator)
    {
        $this->validators[$key][] = $validator;
    }
    
    /**
     * @return array|string[][]
     */
    public function getMessages(): array
    {
        return $this->messages;
    }

    /**
     * @return array|string[]
     */
    public function getMessagesFor(string $key): array
    {
        return $this->messages[$key] ?? [];
    }
    
    /**
     * Get registered validators for given key
     * @param type $key
     * @return array
     */
    public function getValidators($key): array
    {
        return $this->validators[$key] ?? [];
    }
}
