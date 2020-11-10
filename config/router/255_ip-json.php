<?php
/**
 * Route for ip-api
 */
return [
    "routes" => [
        [
            "info" => "Ipcheck.",
            "mount" => "ip-json2",
            "handler" => "\Anax\Ipvalidator2\JsonApiController",
        ],
    ]
];
