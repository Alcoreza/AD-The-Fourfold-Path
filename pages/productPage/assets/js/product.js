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