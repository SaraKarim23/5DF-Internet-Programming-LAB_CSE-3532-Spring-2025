<script>
  document.getElementById('logoutBtn').addEventListener('click', function () {
    // Optional: Clear local/session storage
    localStorage.clear();
    sessionStorage.clear();

    // Optional: Call logout API endpoint if needed
    // fetch('/logout', { method: 'POST' });

    // Redirect to login page
    window.location.href = 'login.html'; // <- Make sure this page exists
  });
</script>

