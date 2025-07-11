let total = 0;
const cartItems = document.getElementById("cartItems");
const totalPrice = document.getElementById("totalPrice");

const quantities = {
  "Purified Water": 1,
  "Spring Water": 1,
  "Distilled Water": 1,
  "Alkaline Water": 1
};

// ✅ Cart-এ Add করার জন্য ঠিক করা ফাংশন
function addToCart(item, pricePerLiter) {
  const quantity = quantities[item];
  const itemTotal = pricePerLiter * quantity;

  const li = document.createElement("li");
  li.innerHTML = `
    ${item} - ${quantity}L x ৳${pricePerLiter} = ৳${itemTotal}
    <button class="remove-btn" onclick="removeItem(this, ${itemTotal})">❌</button>
  `;

  cartItems.appendChild(li);
  total += itemTotal;
  totalPrice.textContent = total;
}

// ✅ Quantity পরিবর্তনের জন্য ফাংশন
function changeQuantity(item, change, pricePerLiter) {
  quantities[item] += change;
  if (quantities[item] < 1) quantities[item] = 1;
  document.getElementById("qty-" + item).textContent = quantities[item];
}

// ✅ Cart থেকে Remove করার ফাংশন
function removeItem(button, itemTotal) {
  const li = button.parentElement;
  li.remove();
  total -= itemTotal;
  totalPrice.textContent = total;
}

// ✅ Water Tracker ফাংশন (Fixed Template String)
function trackWater() {
  const intake = parseFloat(document.getElementById("waterIntake").value);
  const result = document.getElementById("intakeResult");

  if (isNaN(intake) || intake <= 0) {
    result.textContent = "Please enter a valid number.";
    result.style.color = "red";
  } else if (intake >= 3) {
    result.textContent = `Great! You drank ${intake}L today. You're well hydrated. 💧`;
    result.style.color = "green";
  } else {
    result.textContent = `You drank ${intake}L. Try to drink a little more!`;
    result.style.color = "orange";
  }
}