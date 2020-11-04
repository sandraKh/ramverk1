<?php
namespace Anax\Ipvalidator;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;

/**
 * A sample controller to show how a controller class can be implemented.
* The controller will be injected with $di if implementing the interface
* ContainerInjectableInterface, like this sample class does.
* The controller is mounted on a particular route and can then handle all
* requests for that mount point.
*
* @SuppressWarnings(PHPMD.TooManyPublicMethods)
*/
class Iphelper implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    public function isValid($ipAddress)
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            return true;
        }
        return false;
    }

    public function getDomain($ipAddress)
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP)) {
            return gethostbyaddr($ipAddress);
        }
    }


    public function getIpv($ipAddress)
    {
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return "IPv4";
        }
        if (filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            return "IPv6";
        }
        return "Undefined";
    }
}
