<?php
/**
 * Flat file controller for reading markdown files from content/.
 */
return [
    "routes" => [
        [
            "info" => "Flat file content controller.",
            "mount" => "book",
            "handler" => "\Anax\Book\BookController",
        ],
    ]
];
