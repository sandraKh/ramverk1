<?php

namespace Anax\Ipvalidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Route\Exception\NotFoundException;

/**
* A controller to ease with development and debugging information.
*/
class IpvalidatorController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    // private $ipHelper;

    public function initialize()
    {
        $this->IpValidator = new Iphelper();
    }


    public function indexAction() : object
    {
        $title = "Validate IP";
        $page = $this->di->get("page");

        if ($this->di->get("request")->hasGet("ipaddress")) {
            $session = $this->di->get("session");
            $session->set("ipaddress", $this->di->get("request")->getGet("ipaddress"));

            $ipInfo = $this->getInfo();
            $page->add("ipvalidator/ipvalidate-result", $ipInfo);
        }
        $page->add("ipvalidator/ipvalidate-form", []);
        return $page->render([
            "title" => $title,
        ]);
    }

    public function getInfo()
    {
        $session = $this->di->get("session");
        $ipHelper = $this->IpValidator;


        if ($session->has('ipaddress')) {
            $ipAddress = $session->get("ipaddress");
            $ipInfo["ipAddress"] = $ipAddress;
            $ipInfo["isValid"] = $ipHelper->isValid($ipAddress);
            $ipInfo["ipv"] = $ipHelper->getIpv($ipAddress);
            $ipInfo["domain"] = $ipHelper->getDomain($ipAddress);

            return $ipInfo;
        }
        return [];
    }
}
