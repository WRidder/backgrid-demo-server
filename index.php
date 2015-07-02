<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
MongoLog::setLevel(MongoLog::ALL); // all log levels

// MongoDB backend
$mongoURI = getenv("MONGOLAB_URI");
$options = array("connectTimeoutMS" => 30000);

// DB connection
try {
    // open connection to MongoDB server
    $mongoClient = new MongoClient($mongoURI, $options);
} catch (MongoConnectionException $e) {            
    die('Error connecting to MongoDB server: ' . $e->getMessage());
} catch (MongoException $e) {           
    die('Error: ' . $e->getMessage());
}

// Select database
$mongoDB = $mongoClient->selectDB('heroku_x0p112x4');
$territories = $mongoDB->selectCollection('territories');

// GET REST API
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["territories"])) {
    $filter = !empty($_GET["territories"]) ? json_decode($_GET["territories"]) : array();
    $returnValue = $territories->find($filter);

    // Close database connection
    $mongoClient->close();

    // Return result
    header('Content-Type: application/json');
    exit(json_encode(iterator_to_array($returnValue)));
}
else {
    // Close database connection
    $mongoClient->close();
    die("invalid request");
}