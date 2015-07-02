<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
MongoLog::setLevel(MongoLog::ALL); // all log levels

// MongoDB backend
$mongoURI = getenv("BACKGRIDMONGOAUTH");
$options = array("connectTimeoutMS" => 30000);

// DB connection
try {
    // open connection to MongoDB server
    $mongoClient = new MongoClient($mongoURI, $options );

    // Select database
    $territoriesDB = $mongoClient->selectDB("backgrid-demo");
} catch (MongoConnectionException $e) {            
    die('Error connecting to MongoDB server:' . $e->getMessage());
} catch (MongoException $e) {           
    die('Error: ' . $e->getMessage());
}

// Close database connection
$mongoClient->close();

// GET REST API
if (if ($_SERVER['REQUEST_METHOD'] === 'GET') && isset($_GET["territories"])) {
    $filter = !empty($_GET["territories"]) ? json_decode($_GET["territories"]) : array();
    $returnValue = $territories.find($filter);

    // Return result
    exit(json_encode(iterator_to_array($returnValue)));
}
else {
    die("invalid request");
}
