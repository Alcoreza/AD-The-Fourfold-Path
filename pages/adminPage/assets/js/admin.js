const productList = document.getElementById("productList");
const form = document.getElementById("productForm");
const filter = document.getElementById("elementFilter");

// 🔁 Filter products by element
filter.addEventListener("change", () => {
    const selected = filter.value;
    document.querySelectorAll(".product-card").forEach((card) => {
        const element = card.getAttribute("data-element");
        if (selected === "all" || selected === element) {
            card.style.display = "block";
        } else {
            card.style.display = "none";
        }
    });
});

// 📝 Populate form with product data for editing
productList.addEventListener("click", (e) => {
    if (e.target.classList.contains("edit-btn")) {
        const card = e.target.closest(".product-card");
        form.elements.name.value = card.querySelector(".product-title").textContent;
        form.elements.price.value = card.querySelector(".product-price").textContent.replace(/[₱,]/g, "");
        form.elements.description.value = card.querySelector(".product-desc")?.dataset?.desc || "";

        // Optional: store the product ID in a hidden input if needed
        if (!form.querySelector("input[name='item_id']")) {
            const hidden = document.createElement("input");
            hidden.type = "hidden";
            hidden.name = "item_id";
            hidden.value = e.target.dataset.id;
            form.appendChild(hidden);
        } else {
            form.querySelector("input[name='item_id']").value = e.target.dataset.id;
        }

        window.scrollTo({ top: 0, behavior: "smooth" });
    }

    // 🗑 Handle product delete (AJAX POST to admin.handler.php)
    if (e.target.classList.contains("delete-btn")) {
        const id = e.target.dataset.id;
        if (confirm("Are you sure you want to delete this product?")) {
            // Use POST to admin.handler.php
            const formData = new FormData();
            formData.append("action", "delete");
            formData.append("item_id", id);
            fetch("/handlers/admin.handler.php", {
                method: "POST",
                body: formData
            }).then(() => {
                window.location.reload();
            });
        }
    }
});

// 🆕 Add or Edit product form submission (non-AJAX, but always to admin.handler.php)
form.addEventListener("submit", (e) => {
    // Don't prevent default — let it behave normally
    const itemIdInput = form.querySelector("input[name='item_id']");
    form.action = "/handlers/admin.handler.php";
    if (itemIdInput && itemIdInput.value) {
        // Edit mode → update existing product
        form.querySelector("input[name='action']").value = "update";
    } else {
        // Add mode → new product
        form.querySelector("input[name='action']").value = "add";
    }
});
