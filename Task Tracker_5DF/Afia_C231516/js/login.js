const loginForm = document.getElementById("loginForm");
const errorMessage = document.getElementById("error-message");

loginForm.addEventListener("submit", function (e) {
  e.preventDefault();

  const email = document.getElementById("email").value.trim();
  const password = document.getElementById("password").value.trim();

  if (!email || !password) {
    errorMessage.textContent = "Please enter both email and password.";
    errorMessage.style.display = "block";
    return;
  }

  // Simple hardcoded check (for testing only)
  if (email === "user@example.com" && password === "password123") {
    // Clear any previous error
    errorMessage.textContent = "";
    errorMessage.style.display = "none";

    // Redirect to dashboard
    window.location.href = "dashboard.html"; // adjust path if needed
  } else {
    errorMessage.textContent = "Invalid email or password.";
    errorMessage.style.display = "block";
  }
});
