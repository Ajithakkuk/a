<?php
require 'vendor/autoload.php'; // Include Composer autoloader

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// CORS Headers - Ensure these are placed at the top before any output
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rental";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Database connection failed: " . $conn->connect_error]));
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Validate the email input
    if (empty($email)) {
        echo json_encode(["success" => false, "message" => "Please enter your email."]);
        exit();
    }

    // Check if email exists in the database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if (!$stmt) {
        die(json_encode(["success" => false, "message" => "Database query preparation failed: " . $conn->error]));
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    date_default_timezone_set('Asia/Kolkata');

    if ($result->num_rows > 0) {
        // Generate a verification code
        $verification_code = rand(100000, 999999);  // 6-digit code
        $expiry_time = date("Y-m-d H:i:s", strtotime("+15 minutes")); // Code expiry time

        // Store the verification code and expiry time in the database
        $update_stmt = $conn->prepare("UPDATE users SET verification_code = ?, code_expiry = ? WHERE email = ?");
        if (!$update_stmt) {
            die(json_encode(["success" => false, "message" => "Database query preparation failed: " . $conn->error]));
        }
        
        $update_stmt->bind_param("sss", $verification_code, $expiry_time, $email);

        if ($update_stmt->execute()) {
            // Send email with the verification code using PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Use your SMTP server (e.g., Gmail)
                $mail->SMTPAuth = true;
                $mail->Username = 'ajithgpet@gmail.com'; // Your SMTP username
                $mail->Password = 'zlwy tqba glyh vbci'; // Your SMTP password (Use App Password if using Gmail with 2FA)
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Recipients
                $mail->setFrom('ajithgpet@gmail.com', 'Car Rental');
                $mail->addAddress($email); // Recipient email

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Verification Code';
                $mail->Body = "Your verification code is: <strong>$verification_code</strong>. It will expire in 15 minutes.";

                $mail->send();
                echo json_encode(["Verification code sent. Please check your email."]);
            } catch (Exception $e) {
                echo json_encode(["Message could not be sent. Mailer Error: {$mail->ErrorInfo}"]);
            }
        } else {
            echo json_encode(["message" => "Failed to update verification code."]);
        }
        $update_stmt->close();
    } else {
        echo json_encode(["message" => "No user found with this email."]);
    }

    $stmt->close();
}

$conn->close();
?>
