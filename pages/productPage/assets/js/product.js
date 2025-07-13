function filterProducts(category) {
    const sections = document.querySelectorAll('.product-section');
    sections.forEach(section => {
        if (category === 'all') {
            section.style.display = 'block';
        } else {
            section.style.display = section.classList.contains(category) ? 'block' : 'none';
        }
    });
}