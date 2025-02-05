
document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission
  
    // Get form values
    const email = document.querySelector('[name="email"]').value.trim();
    const password = document.querySelector('[name="password"]').value.trim();
  
    // Validate inputs
    if (email === '' || password === '') {
      alert('Please fill in both fields.');
      return;
    }
  
    if (!validateEmail(email)) {
      alert('Please enter a valid email address.');
      return;
    }
  
    // If validation passes, submit the form data
    const formData = new FormData();
    formData.append('email', email);
    formData.append('password', password);
  
    // Make an AJAX request to send the login data
    fetch('login.php', {
      method: 'POST',
      body: formData,
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Redirect to home page if login is successful
        window.location.href = 'home.php';
      } else {
        alert('Invalid email or password.');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('An error occurred during login. Please try again later.');
    });
  });
  
  // Email validation function
  function validateEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  }
  