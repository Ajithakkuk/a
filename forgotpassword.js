import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';
document.getElementById("forgotPasswordForm").addEventListener("submit", async function (event) {
  event.preventDefault(); // Prevent the default form submission behavior

  // Get the email input value
  const email = document.querySelector('input[name="email"]').value.trim();

  // Basic validation
  if (!email) {
      alert("Please enter your email.");
      return;
  }

  try {
      // Send the email to PHP to generate and send the verification code
      const response = await fetch("forgotpassword.php", {
          method: "POST",
          headers: {
              "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `email=${encodeURIComponent(email)}`
      });

      // Check for successful response
      if (!response.ok) {
          throw new Error('Failed to fetch');
      }

      const result = await response.json();

      if (result.success) {
          alert("Verification code sent. Please check your email.");
          window.location.href = "resetpassword.html"; // Redirect to reset password form
      } else {
          alert(result.message || "Failed to send verification code. Please try again.");
      }
  } catch (error) {
      console.error("Error:", error);
      alert("An error occurred while sending the verification code. Please try again later.");
  }
});
