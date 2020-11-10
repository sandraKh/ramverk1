<?php

namespace Anax\Ipvalidator2;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Route\Exception\NotFoundException;

/**
 * A controller to ease with development and debugging information.
 */
class JsonApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function initialize()
    {
        $this->ipHelper = new Iphelper();
        $this->ipStack = new Ipstackhelper();
    }

    public function indexAction() : array
    {
        $ipAddress = $this->di->request->getGet("ip");

        $ipHelper = new Iphelper();
        $ipStack = new Ipstackhelper();
        $info = $ipStack->getLocation($ipAddress);

        $json = [
            "ipAddress" => $ipAddress,
            "isValid" => $ipHelper->isValid($ipAddress),
            "ipv" => $ipHelper->getIpv($ipAddress) ?? null,
            "domain" => $ipHelper->getDomain($ipAddress) ?? null,
        ];
        $json["location"] = $info;
        return [$json];
    }
}
