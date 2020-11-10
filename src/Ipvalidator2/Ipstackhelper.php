<?php
namespace Anax\Ipvalidator2;

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
class Ipstackhelper implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    protected $key;

    public function __construct()
    {
        $key = require ANAX_INSTALL_PATH . "/config/api_key.php";
        $this->key = $key["key"];
    }

    public function getLocation($ipAddress)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://api.ipstack.com/" . $ipAddress . "?access_key=" . $this->key);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);
        $inJson = json_decode($result, true);
        $location = [
            "longitude" => $inJson['longitude'] ?? null,
            "latitude" => $inJson['latitude'] ?? null,
            "country_name" => $inJson['country_name'] ?? null,
            "city" => $inJson['city'] ?? null
        ];
        return $location;
    }
}
