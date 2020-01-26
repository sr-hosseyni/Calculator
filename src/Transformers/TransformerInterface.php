<?php

namespace Calculator\Transformers;

/**
 *
 * @author sr_hosseini
 */
interface TransformerInterface
{
    public static function transform($object): array;
    public static function reverseTransform(array $data);
}
