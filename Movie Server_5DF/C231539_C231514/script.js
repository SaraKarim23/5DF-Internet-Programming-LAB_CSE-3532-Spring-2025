const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');
const loginToggle = document.getElementById('loginToggle');
const registerToggle = document.getElementById('registerToggle');

function showLogin() {
  loginForm.classList.remove('hidden');
  registerForm.classList.add('hidden');
  loginToggle.classList.add('active');
  registerToggle.classList.remove('active');
}

function showRegister() {
  registerForm.classList.remove('hidden');
  loginForm.classList.add('hidden');
  registerToggle.classList.add('active');
  loginToggle.classList.remove('active');
  document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('.auth-form');
    const emailInput = document.querySelector('input[type="email"]');
    const passwordInput = document.querySelector('input[type="password"]');
  
    form.addEventListener('submit', function (e) {
      // Prevent form submission to check for validation first
      e.preventDefault();
  
      // Check if email is valid
      const email = emailInput.value.trim();
      const password = passwordInput.value.trim();
      let isValid = true;
  
      // Validate email format
      if (!email || !validateEmail(email)) {
        isValid = false;
        alert("Please enter a valid email.");
      }
  
      // Validate password length
      if (!password || password.length < 6) {
        isValid = false;
        alert("Password must be at least 6 characters.");
      }
  
      if (isValid) {
        // Form is valid, you can submit the form here
        form.submit();
      }
    });
  
    // Email validation function
    function validateEmail(email) {
      const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
      return regex.test(email);
    }
  });
<script src="script.js"></script>
</body>
</html>
  
}
