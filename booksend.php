<?php 
session_start();
include('includes/config.php'); // Database connection

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer

// Enable debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if(isset($_POST['submit'])){
    $bookName = $_POST['BookName'];
    $bookMobile = $_POST['BookMobilenumber'];
    $bookEmail = $_POST['BookEmail'];
    $vehicle_id = isset($_POST['vehicle_id']) ? intval($_POST['vehicle_id']) : 0;
    $tripStart = $_POST['trip_start'];
    $tripEnd = $_POST['trip_end'];
    $driverNeeded = $_POST['DriverNeeded'];
    $paymentOption = $_POST['payment_option'];
    $totalAmount = $_POST['TotalAmount'];
    
    // Handle Driving License Upload
    $drivingdl = $_FILES['drivingdl']['name'];
    move_uploaded_file($_FILES['drivingdl']['tmp_name'], "admin/book-img/" . $drivingdl);

    // If payment is UPI, store confirmation code
    $paymentConfirmationCode = ($paymentOption === "UPI") ? $_POST['payment_confirmation_code'] : NULL;

    // Insert into `book` table
    $sql = "INSERT INTO book (BookName, BookMobilenumber, BookEmail, drivingdl, trip_start, trip_end, DriverNeeded, payment_option, payment_confirmation_code, vehicle_id, TotalAmount) 
            VALUES (:BookName, :BookMobilenumber, :BookEmail, :drivingdl, :trip_start, :trip_end, :DriverNeeded, :payment_option, :payment_confirmation_code, :vehicle_id, :TotalAmount)";
    
    $query = $dbh->prepare($sql);
    $query->bindParam(':BookName', $bookName, PDO::PARAM_STR);
    $query->bindParam(':BookMobilenumber', $bookMobile, PDO::PARAM_STR);
    $query->bindParam(':BookEmail', $bookEmail, PDO::PARAM_STR);
    $query->bindParam(':drivingdl', $drivingdl, PDO::PARAM_STR);
    $query->bindParam(':trip_start', $tripStart, PDO::PARAM_STR);
    $query->bindParam(':trip_end', $tripEnd, PDO::PARAM_STR);
    $query->bindParam(':DriverNeeded', $driverNeeded, PDO::PARAM_STR);
    $query->bindParam(':payment_option', $paymentOption, PDO::PARAM_STR);
    $query->bindParam(':payment_confirmation_code', $paymentConfirmationCode, PDO::PARAM_STR);
    $query->bindParam(':vehicle_id', $vehicle_id, PDO::PARAM_INT);
    $query->bindParam(':TotalAmount', $totalAmount, PDO::PARAM_INT);

    if($query->execute()){
        // Get Last Inserted Booking ID
        $id = $dbh->lastInsertId();

        // Send Confirmation Email
        $mail = new PHPMailer(true);

        try {
            // SMTP settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ajithgpet@gmail.com';
            $mail->Password = 'zlwy tqba glyh vbci';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Email details
            $mail->setFrom('ajithgpet@gmail.com', 'Car Rental');
            $mail->addAddress($bookEmail);

            // Email content
            $mail->isHTML(true);
            $mail->Subject = 'Booking Confirmation - Car Rental';
            $mail->Body = "
                <h2>Booking Confirmation</h2>
                <p>Dear <strong>$bookName</strong>,</p>
                <p>Thank you for booking with <strong>Car Rental</strong>. Here are your details:</p>
                <ul>
                    <li><strong>Mobile:</strong> $bookMobile</li>
                    <li><strong>Trip Start:</strong> $tripStart</li>
                    <li><strong>Trip End:</strong> $tripEnd</li>
                    <li><strong>Driver Needed:</strong> $driverNeeded</li>
                    <li><strong>Payment Method:</strong> $paymentOption</li>
                    <li><strong>Total Amount:</strong> ₹$totalAmount</li>
                    <li><strong>Booking ID:</strong> $id</li>
                </ul>
                <p>We look forward to serving you. Have a safe journey! 🚗</p>
                <p><strong>Car Rental Team</strong></p>
            ";

            $mail->send();
            echo json_encode(["Booking confirmed. Email sent."]);
        } catch (Exception $e) {
            echo json_encode(["Email not sent. Error: {$mail->ErrorInfo}"]);
        }
    } else {
        echo json_encode(["Error in booking!"]);
    }
}
?>
