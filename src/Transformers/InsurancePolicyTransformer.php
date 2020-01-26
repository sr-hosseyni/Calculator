<?php

namespace Calculator\Transformers;

use Calculator\Entities\InsurancePolicy;

/**
 * Description of ArrayToInsurancePolicy
 *
 * @author sr_hosseini
 */
class InsurancePolicyTransformer implements TransformerInterface
{

    public static function reverseTransform(array $data)
    {
        return InsurancePolicy::getInstance()
            ->setCarValue($data['carValue'])
            ->setTaxPercent($data['taxPercentage'])
            ->setInstalmentsNumber($data['instalmentsNumber'])
            ->setLocalTime($data['orderTime']);
    }

    /**
     * 
     * @param InsurancePolicy $policy
     * @return array
     */
    public static function transform($policy): array
    {
        return [
            'carValue' => $policy->getCarValue(),
            'taxPercentage' => $policy->getTaxPercent(),
            'instalmentsNumber' => $policy->getInstalmentsNumber()
        ];
    }

}
