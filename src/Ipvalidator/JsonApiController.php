<?php

namespace Anax\Ipvalidator;

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
    }

    public function indexAction() : array
    {
        $ipAddress = $this->di->request->getGet("ip");

        $ipHelper = new Iphelper();

        $json = [
            "ipAddress" => $ipAddress,
            "isValid" => $ipHelper->isValid($ipAddress),
            "ipv" => $ipHelper->getIpv($ipAddress) ?? null,
            "domain" => $ipHelper->getDomain($ipAddress) ?? null,
        ];

        // Deal with the action and return a response.
        return [$json];
    }
}
