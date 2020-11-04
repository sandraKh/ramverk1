<?php
/**
* Routes to ease testing.
*/
return [

  // All routes in order
  "routes" => [
      [
          "info" => "IP-validator Controller.",
          "mount" => "Ipvalidator",
          "handler" => "\Anax\Ipvalidator\IpvalidatorController",
      ],
  ]
];
