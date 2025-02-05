import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
document.getElementById("reservationForm").addEventListener("submit", function (event) {
    event.preventDefault();
    alert("Reservation Submitted!");
  });

  document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
    alert('Login functionality coming soon!');
  });

  
  document.getElementById('logoutButton').addEventListener('click', function() {
    // Display a logout confirmation message
    alert('You have been logged out. Thank you!');
    // Redirect to login page after the message
    window.location.href = 'login.html';
  });
  document.addEventListener("DOMContentLoaded", function () {
    // Check if we are on the home page
    if (document.getElementById("vehicle-list")) {
        fetch("get_vehicles.php")
            .then(response => response.json())
            .then(vehicles => {
                let vehicleList = document.getElementById("vehicle-list");
                vehicleList.innerHTML = "";

                vehicles.forEach(vehicle => {
                    let vehicleCard = `
                        <a href="home.html?id=${vehicle.id}" class="car-card">
                            <h3>${vehicle.VehiclesTitle}</h3>
                            <p class="brand">${vehicle.VehiclesBrand}</p>
                            <img src="admin/img/vehicleimages/${vehicle.Vimage1}" alt="${vehicle.VehiclesTitle}">
                            <div class="car-details">
                                <p><i class="fa fa-car"></i> ${vehicle.VehiclesType}</p>
                                <p><i class="fa fa-cogs"></i> ${vehicle.FuelType}</p>
                                <p><i class="fa fa-user"></i> ${vehicle.SeatingCapacity} seats</p>
                            </div>
                            <p class="price">₹${vehicle.PricePerDay} <span>per day</span></p>
                        </a>
                    `;
                    vehicleList.innerHTML += vehicleCard;
                });
            })
            .catch(error => console.error("Error loading vehicles:", error));
    }

    // Check if we are on the vehicle details page
    if (document.getElementById("vehicle-details")) {
        const urlParams = new URLSearchParams(window.location.search);
        const vehicleId = urlParams.get("id");

        if (!vehicleId) {
            document.getElementById("vehicle-details").innerHTML = "<p>Vehicle not found.</p>";
            return;
        }

        fetch(`get_vehicle.php?id=${vehicleId}`)
            .then(response => response.json())
            .then(vehicle => {
                if (!vehicle) {
                    document.getElementById("vehicle-details").innerHTML = "<p>Vehicle not found.</p>";
                    return;
                }

                document.getElementById("vehicle-details").innerHTML = `
                    <h3>${vehicle.VehiclesTitle} (${vehicle.ModelYear})</h3>
                    <img src="admin/img/vehicleimages/${vehicle.Vimage1}" alt="${vehicle.VehiclesTitle}" class="img-fluid">
                    <p><strong>Brand:</strong> ${vehicle.VehiclesBrand}</p>
                    <p><strong>Type:</strong> ${vehicle.VehiclesType}</p>
                    <p><strong>Fuel Type:</strong> ${vehicle.FuelType}</p>
                    <p><strong>Seating Capacity:</strong> ${vehicle.SeatingCapacity} seats</p>
                    <p><strong>Overview:</strong> ${vehicle.VehiclesOverview}</p>
                    <p><strong>Price Per Day:</strong> ₹${vehicle.PricePerDay}</p>
                    <a href="booking.html?id=${vehicleId}" class="btn btn-primary">Book Now</a>
                `;
            })
            .catch(error => console.error("Error fetching vehicle details:", error));
    }
});
window.addEventListener("message", function (event) {
    if (!event.data.vehicles) return;

    let vehicles = event.data.vehicles;
    let resultsContainer = document.getElementById("results");
    resultsContainer.innerHTML = "";

    if (vehicles.length === 0) {
        resultsContainer.innerHTML = "<p>No vehicles available for the selected criteria.</p>";
        return;
    }

    vehicles.forEach(vehicle => {
        let vehicleCard = `
            <div class="card" style="width: 18rem; margin:10px;">
                <img src="admin/vehicle-images/${vehicle.Vimage1}" class="card-img-top" alt="${vehicle.VehiclesTitle}">
                <div class="card-body">
                    <h5 class="card-title">${vehicle.VehiclesTitle} (${vehicle.VehiclesBrand})</h5>
                    <p class="card-text">Price per day: ₹${vehicle.PricePerDay}</p>
                    <p class="card-text">Fuel Type: ${vehicle.FuelType}</p>
                    <p class="card-text">Seating Capacity: ${vehicle.SeatingCapacity}</p>
                    <a href="car-details.html?vehicle_id=${vehicle.id}" class="btn btn-primary">Book Now</a>
                </div>
            </div>
        `;
        resultsContainer.innerHTML += vehicleCard;
    });
});
