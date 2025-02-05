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

  var myCarousel = document.querySelector('#vehicleCarousel');
var carousel = new bootstrap.Carousel(myCarousel, {
    interval: 3000, // Slide interval (in milliseconds)
    ride: 'carousel'
});
