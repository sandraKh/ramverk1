<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "weatherhelper" => [
            "shared" => true,
            "callback" => function () {
                $weatherhelper = new \Anax\Weather\Weatherhelper();

                // Load the configuration files
                $cfg = $this->get("configuration");
                $config = $cfg->load("weather_key.php");

                // Set Api key
                $weatherhelper->setKey($config["config"]["key"]);

                return $weatherhelper;
            }
        ],
    ],
];
