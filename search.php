<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Database connection
$host = '127.0.0.1';
$dbname = 'rental';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// Get parameters
$vehicle_type = $_GET['vehicle_type'] ?? '';
$city = $_GET['city'] ?? '';
$start_date = $_GET['start_date'] ?? '';
$end_date = $_GET['end_date'] ?? '';

if (!$vehicle_type || !$city || !$start_date || !$end_date) {
    echo json_encode(["error" => "Invalid parameters"]);
    exit;
}

// Query database
$sql = "SELECT * FROM vehicles 
        WHERE VehiclesType = '$vehicle_type' 
        AND VehiclesBranch = '$city' 
        AND VehiclesAvailability <= '$start_date' 
        AND (VehiclesUnAvailability IS NULL OR VehiclesUnAvailability >= '$end_date')";

$result = $conn->query($sql);

$vehicles = [];
while ($row = $result->fetch_assoc()) {
    $vehicles[] = $row;
}

// Return JSON response
echo json_encode($vehicles);
?>
