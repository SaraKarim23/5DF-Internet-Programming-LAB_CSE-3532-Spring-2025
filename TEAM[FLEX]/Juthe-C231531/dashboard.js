// Open Modal
function openModal(modalId) {
    document.getElementById(modalId).style.display = "block";
  }
  
  // Close Modal
  function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
  }
  
  // Process Transaction (Placeholder)
  function processTransaction(type) {
    let amount = type === 'buy' 
      ? document.getElementById("buyAmount").value 
      : document.getElementById("sellAmount").value;
  
    if (amount <= 0) {
      alert("Please enter a valid amount!");
      return;
    }
  
    alert(`${type === 'buy' ? "Buying" : "Selling"} ${amount} USD worth of crypto!`);
    closeModal(type === 'buy' ? "buyCryptoModal" : "sellCryptoModal");
  }
  
  // Close modal if clicking outside
  window.onclick = function(event) {
    if (event.target.classList.contains("modal")) {
      event.target.style.display = "none";
    }
  };
  