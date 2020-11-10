<?php

namespace Anax\Ipvalidator;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

class IpcheckController2Test extends TestCase
{

    protected function setUp()
    {
        global $di;

        $this->di = new DIFactoryConfig();
        $di = $this->di;
        $di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        $di->get('cache')->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $this->controller = new IpvalidatorController();
        $this->controller->setDI($this->di);

        $this->controller->initialize();
    }

    public function testgetInfo()
    {
        $session = $this->di->get("session");
        $session->set("ipaddress", "158.174.92.90");

        $res = $this->controller->getInfo();
        $exp = [
            "ipAddress" => "158.174.92.90",
            "isValid" => true,
            "ipv" => "IPv4",
            "domain" => "h-92-90.A1314.priv.bahnhof.se"
        ];
        $this->assertEquals($exp, $res);
        $session->destroy();
    }

    public function testgetInfoIpv6()
    {
        $session = $this->di->get("session");
        $session->set("ipaddress", "0:0:0:0:0:0:0:0");

        $res = $this->controller->getInfo();
        $exp = [
            "ipAddress" => "0:0:0:0:0:0:0:0",
            "isValid" => true,
            "ipv" => "IPv6",
            "domain" => "LAPTOP-ESKB9N8E"
        ];
        $this->assertEquals($exp, $res);
        $session->destroy();
    }

    public function testIndexActionGet()
    {
        $this->di->get("request")->setGet("ipaddress", "37.44.205.237");

        $res = $this->controller->indexAction();
        $this->assertIsObject($res);
        $this->assertInstanceOf("Anax\Response\Response", $res);
        $this->assertInstanceOf("Anax\Response\ResponseUtility", $res);
    }
}
