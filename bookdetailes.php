<?php 
session_start();
include('includes/config.php'); // Include database connection

if(isset($_POST['submit'])){
    $bookName = $_POST['BookName'];
    $bookMobile = $_POST['BookMobilenumber'];
    $bookEmail = $_POST['BookEmail'];
    $vehicle_id = isset($_POST['vehicle_id']) ? intval($_POST['vehicle_id']) : 0;
 // Get vehicle ID
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
        echo "Booking added successfully!";
        
    } else {
        echo "Error in booking!";
    }
}
?>
