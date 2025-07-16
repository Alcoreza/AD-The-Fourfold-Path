document.addEventListener("DOMContentLoaded", () => {
  // Attach listeners immediately since cart items are rendered in PHP
  attachQuantityListeners();
});

function attachQuantityListeners() {
  document.querySelectorAll(".qty-btn").forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault(); // prevent any default behavior (just in case)

      const card = button.closest(".cart-card");
      const qtySpan = card.querySelector(".qty");

      const cartItemId = card.dataset.cartItemId;
      const price = parseFloat(card.dataset.price);
      const action = button.dataset.action;

      let quantity = parseInt(qtySpan.textContent);
      quantity = action === "plus" ? quantity + 1 : quantity - 1;

      if (quantity < 0) return;

      // Update UI immediately
      qtySpan.textContent = quantity;

      // Send quantity update to backend
      fetch("/handlers/cartItems.handler.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
        },
        body: new URLSearchParams({
          action: "update",
          cart_item_id: cartItemId,
          quantity: quantity,
        }),
      })
        .then((res) => {
          if (res.status === 204) return null; // Silent success
          return res.json();
        })
        .then((data) => {
          if (data?.error) {
            alert(data.error);
            return;
          }

          // If quantity becomes 0, remove the item from DOM
          if (quantity === 0) {
            card.remove();
            const remaining = document.querySelectorAll(".cart-card").length;
            if (remaining === 0) {
              document.getElementById("cart-items").style.display = "none";
              document.getElementById("cart-empty").style.display = "block";
              document.getElementById("checkout-section").style.display =
                "none";
            }
          }
        })
        .catch((err) => {
          console.error("Error updating cart item:", err);
        });
    });
  });
}