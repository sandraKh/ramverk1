<?php
/**
 * Route for ip-api
 */
return [
    "routes" => [
        [
            "info" => "weathercheck.",
            "mount" => "weather-json",
            "handler" => "\Anax\Weather\JsonApiController",
        ],
    ]
];
