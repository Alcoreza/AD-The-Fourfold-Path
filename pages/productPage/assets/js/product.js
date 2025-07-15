function filterProducts(category) {
    const sections = document.querySelectorAll('.product-section');
    sections.forEach(section => {
        if (category === 'all' || section.classList.contains(category)) {
            section.style.display = 'block';
            const cards = section.querySelectorAll('.product-card');
            cards.forEach((card, index) => {
                card.classList.remove('show');
                setTimeout(() => {
                    card.classList.add('show');
                }, index * 100);
            });
        } else {
            section.style.display = 'none';
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    filterProducts('all');

    // 🛒 Add to cart button behavior
    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', () => {
            const formData = new FormData();
            formData.append('title', button.dataset.title);
            formData.append('price', button.dataset.price); // optional, not used in backend
            formData.append('nation', button.dataset.nation); // optional, not used in backend
            formData.append('quantity', 1); // static quantity for now

            fetch('/handlers/addToCart.handler.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    alert('✅ ' + data.success);
                } else {
                    alert('❌ ' + (data.error || 'Error adding to cart.'));
                }
            })
            .catch(err => {
                alert('🚫 Network error.');
                console.error(err);
            });
        });
    });
});
