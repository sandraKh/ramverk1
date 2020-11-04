<?php
/**
 * Route for ip-api
 */
return [
    "routes" => [
        [
            "info" => "Ipcheck.",
            "mount" => "ip-json",
            "handler" => "\Anax\Ipvalidator\JsonApiController",
        ],
    ]
];
