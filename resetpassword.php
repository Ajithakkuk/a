<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure JSON response
    header('Content-Type: application/json');

    $email = $_POST['email'];
    $verification_code = $_POST['verification_code'];
    $new_password = $_POST['new_password'];

    // Validate input fields
    if (empty($email) || empty($verification_code) || empty($new_password)) {
        echo json_encode(["success" => false, "message" => "Please fill in all fields."]);
        exit();
    }

    // Check if the verification code and email are valid
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND verification_code = ? AND code_expiry > NOW()");
    $stmt->bind_param("ss", $email, $verification_code);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update password
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_stmt = $conn->prepare("UPDATE users SET password = ?, verification_code = NULL, code_expiry = NULL WHERE email = ?");
        $update_stmt->bind_param("ss", $hashed_password, $email);

        if ($update_stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Password reset successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to reset password. Please try again later."]);
        }
        $update_stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Invalid or expired verification code."]);
    }

    $stmt->close();
    $conn->close();
}
?>
