
document.addEventListener("DOMContentLoaded", () => {
    console.log("Footer Loaded Successfully!");
});
fetch('footer.html')
  .then(response => response.text())
  .then(data => {
    // Insert the header HTML into the placeholder
    document.getElementById('footer-placeholder').innerHTML = data;

  })
  .catch(error => console.error('Error loading header:', error));