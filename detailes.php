<?php
// Database connection
$conn = new mysqli("127.0.0.1", "root", "", "rental");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Vehicle ID is missing.");
}

$vehicle_id = intval($_GET['id']); // Get vehicle ID from URL

$sql = "SELECT * FROM vehicles WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vehicle_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die("Vehicle not found.");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row["VehiclesTitle"]; ?> Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="detailes.css">
    
</head>
<body>
    <div class="container">
      <div class="car-header">
        <div class="car-image">
        <img src="admin/vehicle-images/<?php echo $row["Vimage1"]; ?>" width="400px" alt="<?php echo $row["VehiclesTitle"]; ?>">
        </div>
        <div class="car-details">
        <h2> <?php echo $row["VehiclesBrand"]; ?></h2>
        <h1><?php echo $row["VehiclesTitle"]; ?></h1>
        
        <p><strong>Branch:</strong> <?php echo $row["VehiclesBranch"]; ?></p>
        <p><strong>Fuel Type:</strong> <?php echo $row["FuelType"]; ?></p>
        <p><strong>Seats:</strong> <?php echo $row["SeatingCapacity"]; ?></p>
        <p><strong>Year:</strong> <?php echo $row["ModelYear"]; ?></p>
        <p class="car-price"><strong>Price Per Day:</strong> ₹<?php echo $row["PricePerDay"]; ?></p>
        <!-- Fetch PricePerDay from PHP -->

    </div>
</div>
<div class="traveller-details">
      <div class="section-title">Traveller Details</div>
      <form class="traveller-form" action="booksend.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" id="PricePerDay" value="<?php echo $row["PricePerDay"]; ?>">
            <!-- Full Name -->
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="BookName" required>
            </div>

            <!-- Mobile Number -->
            <div class="mb-3">
                <label class="form-label">Mobile Number</label>
                <input type="text" class="form-control" name="BookMobilenumber" required>
            </div>

            <!-- Email Address -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="BookEmail" required>
            </div>

            <!-- Vehicle Selection -->
            <div class="mb-3">
                <label class="form-label">Select Vehicle:</label>
                <input type="hidden" name="vehicle_id" value="<?php echo $row["VehiclesTitle"]; ?>">

            </div>
            <div class="mb-3">
                <label class="form-label">vehicle_id:</label>
            <input type="hidden" name="vehicle_id" value="<?php echo $vehicle_id; ?>">
            </div>

            <!-- Driving License Upload -->
            <div class="mb-3">
                <label class="form-label">Upload Driving License</label>
                <input type="file" class="form-control" name="drivingdl" accept="image/*" required>
            </div>

            <!-- Trip Start Date & Time -->
            <div class="mb-3">
                <label class="form-label">Trip Start Date & Time</label>
                <input type="datetime-local" class="form-control" name="trip_start" required>
            </div>

            <!-- Trip End Date & Time -->
            <div class="mb-3">
                <label class="form-label">Trip End Date & Time</label>
                <input type="datetime-local" class="form-control" name="trip_end" required>
            </div>

            <!-- Total Days -->
<div class="mb-3">
    <label class="form-label">Total Days</label>
    <input type="number" class="form-control" name="total_days" id="total_days" readonly>
</div>

<!-- Total Price (Auto Calculate) -->
<div class="mb-3">
    <label class="form-label">Total Amount (₹)</label>
    <input type="text" class="form-control" name="TotalAmount" id="TotalAmount" readonly>
</div>


            <!-- Driver Needed -->
            <div class="mb-3">
                <label class="form-label">Do you need a driver?</label>
                <select class="form-control" name="DriverNeeded">
                    <option value="No">No</option>
                    <option value="2000">Yes</option>
                </select>
            </div>

            <!-- Payment Option -->
            <div class="mb-3">
                <label class="form-label">Payment Option</label>
                <select class="form-control" name="payment_option" id="payment_option" required>
                    <option value="Cash">Cash</option>
                    <option value="UPI">UPI</option>
                </select>
            </div>

            <!-- Payment Confirmation Code (Only for UPI) -->
            <div class="mb-3" id="upi_code" style="display:none;">
                <label class="form-label">UPI Payment Confirmation Code</label>
                <input type="text" class="form-control" name="payment_confirmation_code">
            </div>

    <script>
        // Show UPI confirmation code field if UPI is selected
        document.getElementById('payment_option').addEventListener('change', function() {
            var upiField = document.getElementById('upi_code');
            if (this.value === 'UPI') {
                upiField.style.display = 'block';
            } else {
                upiField.style.display = 'none';
            }
        });

        
    </script>


       <!-- Terms and Conditions Section -->
<div class="checkbox-container">
  <input type="checkbox" id="terms-and-conditions">
  <label for="terms-and-conditions">
    I agree to the 
    <a href="termsandcondition.html" onclick="openTermsModal(event)">Terms and Conditions</a>
  </label>
</div>



<script>
function openTermsModal(event) {
  event.preventDefault(); // Prevent the default link behavior
  document.getElementById("terms-modal").style.display = "block";
}

function closeTermsModal() {
  document.getElementById("terms-modal").style.display = "none";
}

// Close the modal if the user clicks outside of it
window.onclick = function (event) {
  const modal = document.getElementById("terms-modal");
  if (event.target === modal) {
    modal.style.display = "none";
  }
};
</script>

<!-- Submit Button -->
<button type="submit" name="submit" class="btn btn-primary">Book Now</button>
        </form>
    </div>
    <script>

    </script>
    
    
    <div class="car-right">
      <div class="car-location">
        <div class="section-title">Car Location</div>
        <p>71/2, 6th Cross Rd, 2nd Stage Indiranagar, BDA Colony, Domlur Village, Domlur, Bengaluru, Karnataka 560071, India</p>
        <button>Get Directions</button>
      </div>
    
      <div class="features">
        <div class="section-title">Features</div>
        <div class="features-list">
          <p> <?php echo $row["VehiclesOverview"]; ?></p>
        </div>
      </div>
    
      <div class="cancellation">
        <div class="section-title">Cancellation</div>
        <p>This booking is non-refundable.</p>
      </div>
    </div>
  </div>

  

  <script>
function openTermsModal(event) {
  event.preventDefault(); // Prevent the default link behavior
  document.getElementById("terms-modal").style.display = "block";
}

function closeTermsModal() {
  document.getElementById("terms-modal").style.display = "none";
}

// Close the modal if the user clicks outside of it
window.onclick = function (event) {
  const modal = document.getElementById("terms-modal");
  if (event.target === modal) {
    modal.style.display = "none";
  }
};
</script>

</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const fromDateInput = document.querySelector("input[name='trip_start']");
    const toDateInput = document.querySelector("input[name='trip_end']");
    const totalDaysInput = document.getElementById("total_days");
    const totalAmountInput = document.getElementById("TotalAmount");
    const driverSelect = document.querySelector("select[name='DriverNeeded']");
    const pricePerDay = <?php echo $row["PricePerDay"]; ?>; // Get price from PHP
    const driverCharge = 2000; // Fixed charge for driver

    function calculateTotal() {
        let fromDate = new Date(fromDateInput.value);
        let toDate = new Date(toDateInput.value);
        let driverNeeded = driverSelect.value === "2000"; // Check if driver is selected
        
        if (fromDate && toDate && toDate >= fromDate) {
            let timeDiff = toDate.getTime() - fromDate.getTime();
            let days = Math.ceil(timeDiff / (1000 * 3600 * 24)); // Convert milliseconds to days
            let totalAmount = days * pricePerDay;

            if (driverNeeded) {
                totalAmount += driverCharge; // Add driver charge if selected
            }

            if (days > 0) {
                totalDaysInput.value = days; // Update Total Days
                totalAmountInput.value = totalAmount; // Update Total Amount
            } else {
                totalDaysInput.value = "";
                totalAmountInput.value = "";
            }
        } else {
            totalDaysInput.value = "";
            totalAmountInput.value = "";
        }
    }

    fromDateInput.addEventListener("change", calculateTotal);
    toDateInput.addEventListener("change", calculateTotal);
    driverSelect.addEventListener("change", calculateTotal); // Recalculate when driver option changes
});
</script>

</body>
</html>
