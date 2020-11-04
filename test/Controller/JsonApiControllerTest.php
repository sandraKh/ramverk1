<?php

namespace Anax\Ipvalidator;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the IpAPIControllerTest.
 */
class JsonApiControllerTest extends TestCase
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

        $di->get('cache')->setPath(ANAX_INSTALL_PATH . "/test/cache");

        $this->controller = new JsonApiController();
        $this->controller->setDI($this->di);

        $this->controller->initialize();
    }

    public function testIndexAction()
    {

        $this->di->get("request")->setGet("ip", "234");
        $res = $this->controller->indexAction();
        $exp = [[
            "ipAddress" => "234",
            "isValid" => false,
            "ipv" => "Undefined",
            "domain" => null
        ]];
        $this->assertEquals($exp, $res);
    }
}
