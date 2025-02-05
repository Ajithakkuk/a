import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
document.getElementById("resetPasswordForm").addEventListener("submit", async function (event) {
  event.preventDefault(); // Prevent the default form submission behavior

  const email = document.querySelector('input[name="email"]').value.trim();
  const verificationCode = document.querySelector('input[name="verification_code"]').value.trim();
  const newPassword = document.querySelector('input[name="new_password"]').value.trim();

  // Basic validation
  if (!email || !verificationCode || !newPassword) {
    alert("Please fill in all fields.");
    return;
  }

  // Password validation (example: minimum 6 characters)
  if (newPassword.length < 6) {
    alert("Password must be at least 6 characters long.");
    return;
  }

  try {
    // Send the data to the PHP script to verify the code and reset the password
    const response = await fetch("resetpassword.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `email=${encodeURIComponent(email)}&verification_code=${encodeURIComponent(verificationCode)}&new_password=${encodeURIComponent(newPassword)}`
    });

    const result = await response.json();

    if (result.success) {
      alert("Password reset successfully. You can now log in.");
      window.location.href = "login.html"; // Redirect to login page
    } else {
      alert(result.message || "Failed to reset password. Please try again.");
    }
  } catch (error) {
    console.error("Error:", error);
    alert("An error occurred while resetting the password. Please try again later.");
  }
});
// This script handles the form submission for resetting the password. It prevents the default form submission, performs basic validation, and sends the data to the PHP script to verify the code and reset the password.