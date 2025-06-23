<?php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function createDatabaseEntry($id, $name, $value) {
    $client = new rabbitMQClient("testRabbitMQ.ini", "testServer");
    
    $request = array(
        "type" => "create_test_entry",
        "data" => array(
            "id" => $id,
            "name" => $name,
            "value" => $value
        )
    );
    
    echo "Sending request to create database entry..." . PHP_EOL;
    $response = $client->send_request($request);
    
    echo "Response received:" . PHP_EOL;
    print_r($response);
    
    return $response;
}

// Example usage
if (isset($argv[1]) && isset($argv[2]) && isset($argv[3])) {
    // Command line usage: php DatabaseClient.php 1 "John Doe" 100
    $id = intval($argv[1]);
    $name = $argv[2];
    $value = intval($argv[3]);
    
    createDatabaseEntry($id, $name, $value);
} else {
    // Default test data
    echo "Creating test entry with default data..." . PHP_EOL;
    createDatabaseEntry(1, "Test User", 42);
}
?>