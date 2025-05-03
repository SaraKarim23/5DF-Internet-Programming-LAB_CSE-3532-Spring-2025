// This handles the form submission.
document.querySelector('#login-form').addEventListener('submit', function(event) {
    event.preventDefault();
    
    const email = document.querySelector('#email').value;
    const password = document.querySelector('#password').value;
  
    if (email && password) {
      alert("Successfully Logged In!");
      window.location.href = "index.html"; // Redirect to Home page after login
    } else {
      alert("Please enter both email and password.");
    }
  });
  