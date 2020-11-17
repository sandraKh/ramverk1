<?php

namespace Anax\Weather;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

class WeatherTest extends TestCase
{

    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $di = $this->di;
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di->get('cache')->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $this->controller = new WeatherController();
        $this->controller->setDI($this->di);

        $this->controller->initialize();
    }

    public function testgetInfo()
    {
        $session = $this->di->get("session");

        $res = $this->controller->getInfo();
        $this->assertNotNull($res);
        $session->destroy();
    }

    public function testgetInfoIpv6()
    {
        $session = $this->di->get("session");
        $session->set("ipaddress", "Paris");

        $res = $this->controller->getInfo();

        $this->assertNotNull($res);
        $session->destroy();
    }

    public function testIndexActionGet()
    {
        $this->di->get("request")->setGet("ipaddress", "Paris");

        $res = $this->controller->indexAction();
        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }
}
