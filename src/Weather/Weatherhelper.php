<?php
namespace Anax\Weather;

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
class Weatherhelper implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;

    protected $apiKey;

    public function setKey(string $key)
    {
        $this->apiKey = $key;
    }

    public function getLocation($ipAddress)
    {
        $get = curl_init();
        curl_setopt($get, CURLOPT_URL, "api.openweathermap.org/data/2.5/forecast?q=" . $ipAddress . "&cnt=7&appid=" . $this->apiKey);
        curl_setopt($get, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($get);
        $inJson = json_decode($result, true);

        $location = [
            "list" => $inJson['list'] ?? null,
        ];

        return $location;
    }

    public function getUsersThroughMultiCurl($params, $city)
    {
        $url = "api.openweathermap.org/data/2.5/find?q=" . $city . "&cnt=";
        $url2 = "&appid=" . $this->apiKey;

        $options = [
            CURLOPT_RETURNTRANSFER => 1,
        ];

        // Add all curl handlers and remember them
        // Initiate the multi curl handler
        $mhh = curl_multi_init();
        $chAll = [];
        foreach ($params as $param) {
            $ch = curl_init($url . $param . $url2);
            curl_setopt_array($ch, $options);
            curl_multi_add_handle($mhh, $ch);
            $chAll[] = $ch;
        }

        // Execute all queries simultaneously,
        // and continue when all are complete
        $running = null;
        do {
            curl_multi_exec($mhh, $running);
        } while ($running);

        // Close the handles
        foreach ($chAll as $ch) {
            curl_multi_remove_handle($mhh, $ch);
        }
        curl_multi_close($mhh);

        // All of our requests are done, we can now access the results
        $response = [];
        foreach ($chAll as $ch) {
            $data = curl_multi_getcontent($ch);
            $response[] = json_decode($data, true);
        }

        return $response;
    }
}
