
// Redirects to the product page with the selected nation as a URL parameter
function filterProducts(nation) {
    window.location.href = `/pages/productPage/index.php?nation=${nation}`;
}

// Animates product cards when they scroll into view
function observeCards() {
    const observer = new IntersectionObserver(
        (entries, obs) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("show");
                    obs.unobserve(entry.target);
                }
            });
        },
        {
            threshold: 0.15,
        }
    );

    document.querySelectorAll(".product-card").forEach((card) => {
        observer.observe(card);
    });
}

document.addEventListener("DOMContentLoaded", () => {
    observeCards();

    // Attach event listeners to all Add to Cart buttons
    document.querySelectorAll(".add-to-cart-btn").forEach((button) => {
        button.addEventListener("click", () => {
            const formData = new FormData();
            formData.append("title", button.dataset.title);
            formData.append("price", button.dataset.price);
            formData.append("nation", button.dataset.nation);
            formData.append("quantity", 1);

            fetch("/handlers/addToCart.handler.php", {
                method: "POST",
                body: formData,
            })
                .then((res) => res.json())
                .then((data) => {
                    alert(data.success || data.error || "Unknown response.");
                })
                .catch((err) => {
                    alert("Network error.");
                    console.error(err);
                });
        });
    });
});
