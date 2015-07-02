<?php
// MongoDB backend
$mongoAuth = getenv("BACKGRIDMONGOAUTH");

// DB connection
$mongoDB = new Mongo($mongoAuth);

// Territories collection
$territories = $mongoDB->territories;

// GET REST API
if (if ($_SERVER['REQUEST_METHOD'] === 'GET') && isset($_GET["territories"])) {
    $filter = !empty($_GET["territories"]) ? json_decode($_GET["territories"]) : array();
    $returnValue = $territories.find($filter);

    // Return result
    exit(json_encode(iterator_to_array($returnValue)));
}
else {
    exit("invalid request");
}
