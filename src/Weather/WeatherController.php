<?php

namespace Anax\Weather;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Route\Exception\NotFoundException;

/**
* A controller to ease with development and debugging information.
*/
class WeatherController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    // private $ipHelper;

    public function initialize()
    {
        $this->GetLocation = new Weatherhelper();
    }


    public function indexAction() : object
    {
        $title = "Weather";
        $page = $this->di->get("page");

        $weatherModel = $this->di->get("weatherhelper");


        if ($this->di->get("request")->hasGet("ipaddress")) {
            $session = $this->di->get("session");
            $session->set("ipaddress", $this->di->get("request")->getGet("ipaddress"));
            // $userContainer = new Weatherhelper();

            $data = $weatherModel->getUsersThroughMultiCurl([30], $this->getQuery());

            $ipInfo = $this->getInfo();
            $page->add("weather/weather-result", $ipInfo);
            $page->add("weather/weather-past", $data);
        }
        $page->add("weather/weather-form", []);
        return $page->render([
            "title" => $title,
        ]);
    }

    public function getInfo()
    {
        $session = $this->di->get("session");

        $weatherModel = $this->di->get("weatherhelper");
        $ipInfo = [];
        $ipAddress = $session->get("ipaddress");

        $weatherModel = $this->di->get("weatherhelper");
        $ipInfo = $weatherModel->getLocation($ipAddress);

        return $ipInfo;
    }

    public function getQuery()
    {
        $session = $this->di->get("session");
        $ipAddress = $session->get("ipaddress");

        return $ipAddress;
    }
}
