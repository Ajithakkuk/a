<?php
header("Content-Type: application/json");

// Get the JSON payload
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Validate the request
if (isset($data['branchName'])) {
    $branchName = $data['branchName'];

    // Simulate booking logic (e.g., save booking to a database)
    // Here, we'll just respond with a success message
    echo json_encode([
        "success" => true,
        "message" => "Booking confirmed for the $branchName branch",
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid booking request",
    ]);
}
?>
