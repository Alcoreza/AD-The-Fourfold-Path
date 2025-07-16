document.addEventListener("DOMContentLoaded", () => {
  fetch("/handlers/cartItems.handler.php")
    .then((res) => res.json())
    .then((cartItems) => {
      const cartItemsDiv = document.getElementById("cart-items");
      const emptyDiv = document.getElementById("cart-empty");
      const checkoutSection = document.getElementById("checkout-section");

      if (!cartItems || cartItems.length === 0 || cartItems.error) {
        cartItemsDiv.style.display = "none";
        emptyDiv.style.display = "block";
        checkoutSection.style.display = "none";
        return;
      }

      emptyDiv.style.display = "none";
      cartItemsDiv.style.display = "flex";
      checkoutSection.style.display = "block";

      cartItems.forEach((item) => {
        const card = document.createElement("div");
        card.className = "cart-card";
        card.dataset.cartItemId = item.cart_item_id;
        card.dataset.price = item.price;

        card.innerHTML = `
          <img src="${item.image_url}" alt="${item.name}" />
          <div class="card-details">
              <h3>${item.name}</h3>
              <p>₱${item.price}</p>
              <div class="quantity-controls">
                  <button class="qty-btn" data-action="minus">−</button>
                  <span class="qty">${item.quantity}</span>
                  <button class="qty-btn" data-action="plus">+</button>
              </div>
              <p class="total">Total: ₱${(item.price * item.quantity).toFixed(2)}</p>
          </div>
        `;
        cartItemsDiv.appendChild(card);
      });

      addQuantityListeners();
    });
});

function addQuantityListeners() {
  document.querySelectorAll(".qty-btn").forEach((button) => {
    button.addEventListener("click", () => {
      const card = button.closest(".cart-card");
      const qtySpan = card.querySelector(".qty");
      const totalText = card.querySelector(".total");
      const price = parseFloat(card.dataset.price);
      const cartItemId = card.dataset.cartItemId;
      const action = button.dataset.action;

      let quantity = parseInt(qtySpan.textContent);
      quantity = action === "plus" ? quantity + 1 : quantity - 1;
      if (quantity < 0) return;

      qtySpan.textContent = quantity;
      totalText.textContent = `Total: ₱${(quantity * price).toFixed(2)}`;

      fetch("/handlers/cartItems.handler.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: new URLSearchParams({
          action: "update",
          cart_item_id: cartItemId,
          quantity: quantity,
        }),
      })
        .then((res) => res.json())
        .then((data) => {
          if (quantity === 0) {
            card.remove();
            if (document.querySelectorAll(".cart-card").length === 0) {
              document.getElementById("cart-items").style.display = "none";
              document.getElementById("cart-empty").style.display = "block";
              document.getElementById("checkout-section").style.display = "none";
            }
          }
        })
        .catch((err) => console.error("Error updating quantity:", err));
    });
  });
}
