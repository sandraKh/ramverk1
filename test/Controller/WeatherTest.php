<?php

namespace Anax\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the IpAPIControllerTest.
 */
class WeatherTest extends TestCase
{

    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $di = $this->di;
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
        $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");

        $this->controller = new WeatherController();
        $this->controller->setDI($di);
        $this->controller->initialize();
    }

    public function testLocation()
    {
        $this->di->get("request")->setGet("city", "Paris");
        $res = $this->controller->getInfo();
        $this->assertNotNull($res);
    }

    public function testQuery()
    {
        $this->di->get("request")->setGet("city", "Paris");
        $res = $this->controller->getQuery();
        $this->assertequals($res, null);


        $this->di->get("request")->setGet("Paris");

        $res1 = $this->controller->indexAction();
        $this->assertIsObject($res1);


        $weatherModel = $this->di->get("weatherhelper");
        $data = $weatherModel->getUsersThroughMultiCurl([1], "Paris");
        $this->assertNotNull($data);

    }

    public function testgetInfoIpv6()
        {
            $session = $this->di->get("session");
            $session->set("ipaddress", "Paris");

            $res = $this->controller->getInfo();

            $this->assertNotNull($res);
            $session->destroy();
        }

    // public function testIndexAction()
    // {
    //     $this->di->get("request")->setGet("Paris");
    //     $res = $this->controller->indexAction();
    //     $this->assertNotNull($res);
    // }
}


// class Weather2Test extends TestCase
// {
//
//     protected function setUp()
//     {
//         global $di;
//
//         $this->di = new DIFactoryConfig();
//         $di = $this->di;
//         $di->loadServices(ANAX_INSTALL_PATH . "/config/di");
//         $di->loadServices(ANAX_INSTALL_PATH . "/test/config/di");
//
//         $this->controller = new WeatherController();
//         $this->controller->setDI($di);
//         //$this->controller->initialize();
//     }
//
//     // public function testgetInfo()
//     // {
//     //     $session = $this->di->get("session");
//     //
//     //     $res = $this->controller->getInfo();
//     //     $this->assertNotNull($res);
//     //     $session->destroy();
//     // }
//
//     // public function testgetInfoIpv6()
//     // {
//     //     $session = $this->di->get("session");
//     //     $session->set("ipaddress", "Paris");
//     //
//     //     $res = $this->controller->getInfo();
//     //
//     //     $this->assertNotNull($res);
//     //     $session->destroy();
//     // }
//
//     public function testIndexAction()
//     {
//         $this->di->get("request")->setGet("city", "Paris");
//         $res = $this->controller->indexAction();
//         $this->assertNotNull($res);
//     }
// }
