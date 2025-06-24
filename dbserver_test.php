<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

function connectToDatabase() {
    $host = 'test-ajz27-techtitans'; 
    $dbname = 'test_db'; 
    $username = 'root'; 
    $password = ''; 
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        return array("error" => "Database connection failed: " . $e->getMessage());
    }
}

function createTestEntry($data) {
    $pdo = connectToDatabase();
    
    if (is_array($pdo) && isset($pdo['error'])) {
        return $pdo; // Return error if connection failed
    }
    
    try {
        $stmt = $pdo->prepare("INSERT INTO test (id, name, value) VALUES (?, ?, ?)");
        $result = $stmt->execute([$data['id'], $data['name'], $data['value']]);
        
        if ($result) {
            return array(
                "success" => true,
                "message" => "Entry created successfully",
                "id" => $data['id']
            );
        } else {
            return array(
                "success" => false,
                "message" => "Failed to create entry"
            );
        }
    } catch (PDOException $e) {
        return array(
            "success" => false,
            "message" => "Database error: " . $e->getMessage()
        );
    }
}

function request_processor($req) {
    echo "Database Server - Received Request" . PHP_EOL;
    var_dump($req);
    
    if (!isset($req['type'])) {
        return array("error" => "unsupported message type");
    }
    
    switch ($req['type']) {
        case "create_test_entry":
            if (!isset($req['data']['id']) || !isset($req['data']['name']) || !isset($req['data']['value'])) {
                return array(
                    "success" => false,
                    "message" => "Missing required fields: id, name, value"
                );
            }
            return createTestEntry($req['data']);
            
        default:
            return array("error" => "Unknown request type: " . $req['type']);
    }
}

$server = new rabbitMQServer("testRabbitMQ.ini", "sampleServer");
echo "Database Server Started" . PHP_EOL;
$server->process_requests('request_processor');
echo "Database Server Stopped" . PHP_EOL;
?>