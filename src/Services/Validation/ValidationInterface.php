<?php

namespace Calculator\Services\Validation;

/**
 * Description of ValidationService
 *
 * @author sr_hosseini
 */
interface ValidationInterface
{
    public function validateData(array $data): bool;
    public function getMessages(): array;
    public function getMessagesFor(string $key): array;
}
