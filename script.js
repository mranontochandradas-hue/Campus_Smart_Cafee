// Function to add item to cart
function addToCart(foodID, foodName, price) {

    var quantity = parseInt(document.getElementById("quantity" + foodID).value);

    if (isNaN(quantity) || quantity <= 0) {
        alert("Please enter a valid quantity.");
        return;
    }

    var totalItemPrice = price * quantity;

    var itemDiv = document.createElement("div");
    itemDiv.classList.add("selected-item");

    // IMPORTANT
    itemDiv.setAttribute("data-price", totalItemPrice);

    itemDiv.innerHTML = `
        <p class="food-name">${foodName}</p>
        <p class="quantity">Quantity: ${quantity}</p>
        <p class="total-cost">Total: ৳${totalItemPrice.toFixed(2)}</p>
        <button type="button" onclick="removeItem(this)">Remove</button>
    `;

    document.getElementById("selected-items").appendChild(itemDiv);

    updateTotalCost(totalItemPrice);
}

// REMOVE FUNCTION (MUST BE OUTSIDE)
function removeItem(btn) {
    const itemDiv = btn.parentElement;
    const price = parseFloat(itemDiv.dataset.price);

    updateTotalCost(-price);
    itemDiv.remove();
}

// Update total cost
function updateTotalCost(price) {
    var currentTotal = parseFloat(document.getElementById("total-cost").innerText);
    document.getElementById("total-cost").innerText = (currentTotal + price).toFixed(2);
}

// Pay now
function payNow() {
    var totalCost = document.getElementById("total-cost").innerText;
    window.location.href = "payment.php?total=" + totalCost;
}
