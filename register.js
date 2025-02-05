import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
document.getElementById('registerForm').addEventListener('submit', function(event) {
  event.preventDefault();

  // Collect form data
  const username = document.querySelector('[name="username"]').value.trim();
  const email = document.querySelector('[name="email"]').value.trim();
  const password = document.querySelector('[name="password"]').value.trim();
  const confirmPassword = document.querySelector('[name="confirm_password"]').value.trim();

  // Validate fields
  if (!username || !email || !password || !confirmPassword) {
    alert('All fields are required.');
    return;
  }

  if (password !== confirmPassword) {
    alert('Passwords do not match.');
    return;
  }

  // Prepare form data
  const formData = new FormData();
  formData.append('username', username);
  formData.append('email', email);
  formData.append('password', password);

  // Submit to the backend
  fetch('register.php', {
    method: 'POST',
    body: formData,
  })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Registration successful! Redirecting to login page.');
        window.location.href = 'login.html';
      } else {
        alert(data.message);
      }
    })
    .catch(error => {
      console.error('Fetch error:', error);
      alert('An error occurred. Please try again.');
    });
    
});
