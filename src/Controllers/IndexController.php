<?php

namespace Calculator\Controllers;

use Calculator\Application\RequestInterface;
use Calculator\Services\Validation\CalculatorFormValidation;
use Calculator\Transformers\InsurancePolicyTransformer;
use Calculator\BusinessLogic\CalculatorBuilder;

/**
 * Description of IndexController
 *
 * @author sr_hosseini
 */
class IndexController extends BaseController
{
    public function index(RequestInterface $request): string
    {
        return $this->render('index/index');
    }
    
    public function calculate(RequestInterface $request)
    {
        $data = $request->getAllFormData();
        $validation = new CalculatorFormValidation();
        if (!$validation->validateData($data)) {
            return json_encode($validation->getMessages());
        }
        
        $policy = InsurancePolicyTransformer::reverseTransform($data);

        $calculatorBuilder = new CalculatorBuilder($policy);
        $calculator = $calculatorBuilder
                ->applyCommision()
                ->applyTax()
                ->applyInstalments()
                ->applyRounding()
                ->applyRoundingErrorFixer()
                ->applyTotalPrice()
                ->build();
        
        $this->view['policy'] = $policy;
        $this->view['data'] = $calculator->calculate($policy);
        
        return $this->render('index/calculate');
    }
}
