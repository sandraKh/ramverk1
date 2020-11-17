<?php

namespace Anax\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Route\Exception\NotFoundException;

/**
 * A controller to ease with development and debugging information.
 */
class JsonApiController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function indexAction() : array
    {
        $city = $this->di->request->getGet("city");
        $cnt = $this->di->request->getGet("cnt");
        $weatherModel = $this->di->get("weatherhelper");
        $days = explode(" ", $cnt);

        $info = $weatherModel->getUsersThroughMultiCurl($days, $city);

        return [$info];
    }
}
