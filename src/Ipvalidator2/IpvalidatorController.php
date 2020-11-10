<?php

namespace Anax\Ipvalidator2;

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
        $this->GetLocation = new Ipstackhelper();
    }


    public function indexAction() : object
    {
        $title = "Validate IP";
        $IpValidator = $this->IpValidator;
        $page = $this->di->get("page");
        $request = $this->di->get("request");

        if ($this->di->get("request")->hasGet("ipaddress")) {
            $session = $this->di->get("session");
            $session->set("ipaddress", $this->di->get("request")->getGet("ipaddress"));

            $ipInfo = $this->getInfo();
            $page->add("ipvalidator2/ipvalidate-result", $ipInfo);
        }
        $page->add("ipvalidator2/ipvalidate-form", [
            "defaultIP" => $IpValidator->getIp($request),
        ]);
        return $page->render([
            "title" => $title,
        ]);
    }

    public function getInfo()
    {
        $session = $this->di->get("session");
        $ipHelper = $this->IpValidator;
        $loacationHelper = $this->GetLocation;

        $ipInfo = [];
        $ipAddress = $session->get("ipaddress");
        if ($ipHelper->isValid($ipAddress)) {
            $ipInfo = $loacationHelper->getLocation($ipAddress);
        }
        $ipInfo["ipAddress"] = $ipAddress;
        $ipInfo["isValid"] = $ipHelper->isValid($ipAddress);
        $ipInfo["ipv"] = $ipHelper->getIpv($ipAddress);
        $ipInfo["domain"] = $ipHelper->getDomain($ipAddress);

        return $ipInfo;
    }
}
