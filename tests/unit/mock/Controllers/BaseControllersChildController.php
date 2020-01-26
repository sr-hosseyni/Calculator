<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Calculator\Tests\Mock\Controllers;

use Calculator\Controllers\BaseController;
use Calculator\Tests\Mock\Application\DummyRequest;

/**
 * Description of BaseControllersChildController
 *
 * @author sr_hosseini
 */
class BaseControllersChildController extends BaseController
{
    public function testView(DummyRequest $request): string
    {
        $this->view['variable'] = 'somevalue';
        return $this->render('index/test-view');
    }
}
