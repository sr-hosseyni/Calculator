<?php

namespace Calculator\Tests\Controllers;

use Calculator\Tests\Mock\Application\DummyRequest as Request;
use Calculator\Tests\Mock\Controllers\BaseControllersChildController;
use Calculator\Tests\UnitTestCase;

/**
 * Description of BaseControllerTest
 *
 * @author sr_hosseini
 */
class BaseControllerTest extends UnitTestCase
{
    public function viewTestsProvider(): array
    {
        $config = [
            'views_templates_path' => $this->getMockDirPath() . '/views',
        ];
        
        return [
            [$config, '<p>somevalue</p>']
        ];
    }
    
    /**
     * 
     * @param array $config
     * @param string $expected
     * @dataProvider viewTestsProvider
     */
    public function testView(array $config, string $expected)
    {
        $ctrl = new BaseControllersChildController();
        $ctrl->setConfig($config);
        $actual = $ctrl->testView(new Request());
        $this->assertEquals($expected, $actual);
    }
}
