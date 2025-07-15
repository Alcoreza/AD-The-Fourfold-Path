function filterProducts(category) {
    const sections = document.querySelectorAll('.product-section');
    sections.forEach(section => {
        if (category === 'all' || section.classList.contains(category)) {
            section.style.display = 'block';

            const cards = section.querySelectorAll('.product-card');
            cards.forEach(card => card.classList.remove('show'));
        } else {
            section.style.display = 'none';
        }
    });

    observeCards();
}

function observeCards() {
    const observer = new IntersectionObserver((entries, obs) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                obs.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.15
    });

    document.querySelectorAll('.product-card').forEach(card => {
        observer.observe(card);
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const params = new URLSearchParams(window.location.search);
    const nation = params.get('nation') || 'all';

    filterProducts(nation);

    observeCards();

    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', () => {
            const formData = new FormData();
            formData.append('title', button.dataset.title);
            formData.append('price', button.dataset.price);
            formData.append('nation', button.dataset.nation);
            formData.append('quantity', 1);

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