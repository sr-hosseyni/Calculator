<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Calculator\Services\Validation;

use Calculator\Services\Validation\Validators\DecimalRange;
use Calculator\Services\Validation\Validators\IntRange;
use Calculator\Services\Validation\Validators\Required;

/**
 * Description of CalculatorFormValidation
 *
 * @author sr_hosseini
 */
class CalculatorFormValidation extends BaseValidation
{

    public function initialize()
    {
        $this->add('carValue', DecimalRange::getInstance(100, 100000));
        $this->add('carValue', Required::getInstance());

        $this->add('taxPercentage', IntRange::getInstance(0, 100));
        $this->add('taxPercentage', Required::getInstance());

        $this->add('instalmentsNumber', IntRange::getInstance(1, 12));
        $this->add('instalmentsNumber', Required::getInstance());
    }
}
