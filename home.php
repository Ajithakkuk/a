
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <div id="header-placeholder"></div>
    
    <!-- Car Search Bar -->
    <div id="car-search-container">
        <iframe src="search.html" style="border:none; width:100%; height:130px;"></iframe>
        <div id="results" class="d-flex flex-wrap justify-content-center mt-4"></div>

    </div>

    <main>
        <!-- Carousel Section -->
        <section id="carouselSection" class="mb-5">
            <div id="vehicleCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="cimg/bmw3.jpg" class="d-block w-100" alt="Car 1">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Luxury Cars</h5>
                            <p>Experience comfort and style. <a href="car-details.html" class="book-btn">Book Now</a></p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="cimg/in3.jpg" class="d-block w-100" alt="Car 2">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Economy Cars</h5>
                            <p>Affordable and efficient. <a href="car-details.html" class="book-btn">Book Now</a></p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="cimg/thar1.jpg" class="d-block w-100" alt="Car 3">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>Sports Cars</h5>
                            <p>Feel the thrill. <a href="car-details.html" class="book-btn">Book Now</a></p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#vehicleCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#vehicleCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </section>

        <!-- Available Vehicles Section -->
        <div class="section">
            <h2>Available Vehicles</h2>
            <div class="car-cards-wrapper">
            <?php
// Database connection
$conn = new mysqli("127.0.0.1", "root", "", "rental");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM vehicles ORDER BY RegDate DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<a href="detailes.php?id=' . $row["id"] . '" class="car-card">'; // Pass ID in URL
        echo '<h3>' . $row["VehiclesTitle"] . '</h3>';
        echo '<p class="brand">' . $row["VehiclesBrand"] . '</p>';
        echo '<img src="admin/vehicle-images/' . $row["Vimage1"] . '" alt="' . $row["VehiclesTitle"] . '" height="300" width="100">';
        echo '<div class="car-details">';
        echo '<p><strong>Fuel Type:</strong> ' . $row["FuelType"] . '</p>';
        echo '<p><strong>Seats:</strong> ' . $row["SeatingCapacity"] . '</p>';
        echo '<p><strong>Year:</strong> ' . $row["ModelYear"] . '</p>';
        echo '</div>';
        echo '<p class="price">₹' . $row["PricePerDay"] . '<span> per day</span></p>';
        echo '</a>';
    }
} else {
    echo "<p>No vehicles available at the moment.</p>";
}
$conn->close();
?>

            </div>
        </div>
    </main>

    <script src="home.js"></script>
    <script src="headerLoader.js"></script>
</body>
</html>