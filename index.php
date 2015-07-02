<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

// MongoDB backend
$mongoAuth = getenv("BACKGRIDMONGOAUTH");

// DB connection
try {
    // open connection to MongoDB server
    $mongoDB = new MongoClient($mongoAuth);
} catch (MongoConnectionException $e) {            
    die('Error connecting to MongoDB server');
} catch (MongoException $e) {           
    die('Error: ' . $e->getMessage());
}
/*
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
    die("invalid request");
}*/
