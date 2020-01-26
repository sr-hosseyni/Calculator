<?php

namespace Calculator\Tests\Services\Validation\Validators;

use Calculator\Services\Validation\Validators\Required;
use Calculator\Tests\Mock\Services\Validation\SampleValidation;
use Calculator\Tests\Mock\Services\Validation\Validators\FooValidator;
use Calculator\Tests\UnitTestCase;

/**
 * Description of BaseValidationTest
 *
 * @author sr_hosseini
 */
class BaseValidationTest extends UnitTestCase
{
    public function validationTestProvider(): array
    {
        $validators = [
            'key1' => [
                'firstValidatorAcceptableValues' => ['value2', 'value3'],
                'secondValidatorAcceptableValues' => ['value1', 'value3']
            ],
            'key2' => [
                'fisrtValidatorAcceptableValues' => [100]
            ]
        ];

        return [
            [
                $validators,
                $data = ['key1' => 'value1', 'key2' => 100],
                $expected = false,
                $expectedMessagesCount = ['key1' => 1, 'key2' => 0]
            ],
            [
                $validators,
                $data = ['key1' => 'value2', 'key2' => 100],
                $expected = false,
                $expectedMessagesCount = ['key1' => 1, 'key2' => 0]
            ],
            [
                $validators,
                $data = ['key1' => 'value3', 'key2' => 100],
                $expected = true,
                $expectedMessagesCount = ['key1' => 0, 'key2' => 0]
            ],
            [
                $validators,
                $data = ['key1' => 'value4', 'key2' => 100],
                $expected = false,
                $expectedMessagesCount = ['key1' => 2, 'key2' => 0]
            ],
            [
                $validators,
                $data = ['key2' => 100],
                $expected = true,
                $expectedMessagesCount = ['key1' => 0, 'key2' => 0]
            ],
            [
                $validators,
                $data = ['key2' => 101],
                $expected = false,
                $expectedMessagesCount = ['key1' => 0, 'key2' => 1]
            ],
            [
                $validators,
                $data = [],
                $expected = true,
                $expectedMessagesCount = ['key1' => 0, 'key2' => 0]
            ],
            [
                $validators,
                $data = ['key1' => 'value3'],
                $expected = true,
                $expectedMessagesCount = ['key1' => 0, 'key2' => 0]
            ],
            [
                $validators,
                $data = ['key1' => 'value4', 'key2' => 99],
                $expected = false,
                $expectedMessagesCount = ['key1' => 2, 'key2' => 1]
            ],
            [
                $validators,
                $data = ['key1' => 'value2', 'key2' => 99],
                $expected = false,
                $expectedMessagesCount = ['key1' => 1, 'key2' => 1]
            ]
        ];
    }
    
    /**
     * @dataProvider validationTestProvider
     */
    public function testValidate(array $validators, array $data, bool $expected, array $expectedMessagesCount)
    {
        $validation = new SampleValidation();
        foreach ($validators as $key => $keyValidator) {
            foreach ($keyValidator as $values) {
                $validation->add($key, new FooValidator($values));
            }
        }
        $actual = $validation->validateData($data);
        $this->assertEquals($expected, $actual);
        
        foreach ($expectedMessagesCount as $key => $count) {
            $this->assertCount($count, $validation->getMessagesFor($key));
        }
    }
    
    public function testAddMethod()
    {
        $validation = new SampleValidation();
        $validation->add('bar', new FooValidator());
        $this->assertCount(1, $validation->getValidators('bar'));
        $validation->add('bar', new FooValidator());
        $this->assertCount(2, $validation->getValidators('bar'));
        $validation->add('foo', new FooValidator());
        $this->assertCount(1, $validation->getValidators('foo'));
    }
    
    public function validationTestOnRestricModeValidatorsProvider(): array
    {
        return [
            [
                $validators = [
                    'key1' => [Required::class],
                    'key2' => []
                ],
                $data = ['key1' => 'x', 'key2' => 1],
                $expected = true,
            ],
            [
                $validators = [
                    'key1' => [Required::class],
                    'key2' => []
                ],
                $data = ['key1' => 'x'],
                $expected = true,
            ],
            [
                $validators = [
                    'key1' => [Required::class],
                    'key2' => []
                ],
                $data = ['key2' => 1],
                $expected = false,
            ],
            [
                $validators = [
                    'key1' => [Required::class],
                    'key2' => []
                ],
                $data = [],
                $expected = false,
            ],
            [
                $validators = [
                    'key1' => [Required::class],
                    'key2' => [Required::class]
                ],
                $data = ['key1' => 'x'],
                $expected = false,
            ],
            [
                $validators = [
                    'key1' => [Required::class],
                    'key2' => [Required::class]
                ],
                $data = ['key2' => 1],
                $expected = false,
            ],
            [
                $validators = [
                    'key1' => [Required::class],
                    'key2' => [Required::class]
                ],
                $data = [],
                $expected = false,
            ],
            [
                $validators = [
                    'key1' => [Required::class],
                    'key2' => [Required::class]
                ],
                $data = ['key1' => 'x', 'key2' => 1],
                $expected = true,
            ],
            [
                $validators = [
                    'key1' => [Required::class],
                    'key2' => [Required::class]
                ],
                $data = ['key2' => 1],
                $expected = false,
            ],
            [
                $validators = [
                    'key1' => [Required::class],
                    'key2' => [Required::class]
                ],
                $data = ['key1' => 'x'],
                $expected = false
            ]
        ];
    }
    
    /**
     * @param array $validators
     * @param array $data
     * @param bool $expected
     * 
     * @dataProvider validationTestOnRestricModeValidatorsProvider
     */
    public function testValidationOnRestricModeValidators(array $validators, array $data, bool $expected)
    {
        $validation = new SampleValidation();
        foreach ($validators as $key => $keyValidator) {
            foreach ($keyValidator as $validator) {
                $validation->add($key, new $validator());
            }
        }
        $actual = $validation->validateData($data);
        $this->assertEquals($expected, $actual);
    }
}
