const productList = document.getElementById("productList");
const form = document.getElementById("productForm");
const filter = document.getElementById("elementFilter");

let products = [];

// TEMP DUMMY DATA (CHANGE THIS AFTER BACK-END INTEGRATION, ASK GPT FOR SUGGESTION)
products = [
    { name: "Agni Gloves", element: "fire", price: 599, image: "https://i.imgur.com/AgniGloves.jpg" },
    { name: "Sozin’s Brew", element: "fire", price: 399, image: "https://i.imgur.com/SozinTea.jpg" },
    { name: "Ice Fang Boots", element: "water", price: 749, image: "https://i.imgur.com/IceFang.jpg" },
];

function renderProducts() {
    const filterValue = filter.value;
    productList.innerHTML = "";

    products
    .filter(p => filterValue === "all" || p.element === filterValue)
    .forEach((product, index) => {
        const col = document.createElement("div");
        col.className = "col-md-4 mb-4";

        col.innerHTML = `
        <div class="card h-100 shadow-sm">
            <img src="${product.image}" class="card-img-top" alt="${product.name}" style="max-height: 200px; object-fit: cover;">
            <div class="card-body">
                <h5 class="card-title">${product.name}</h5>
                <p class="card-text"><strong>Nation:</strong> ${product.element}</p>
                <p class="card-text"><strong>Price:</strong> ₱${product.price}</p>
                <button class="btn btn-warning btn-sm me-2" onclick="editProduct(${index})">Edit</button>
                <button class="btn btn-danger btn-sm" onclick="deleteProduct(${index})">Delete</button>
            </div>
        </div>
        `;

        productList.appendChild(col);
    });
}

form.addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(form);
    const newProduct = Object.fromEntries(formData);
    products.push(newProduct);
    renderProducts();
    form.reset();
});

filter.addEventListener("change", renderProducts);

function deleteProduct(index) {
    if (confirm("Are you sure you want to delete this product?")) {
        products.splice(index, 1);
        renderProducts();
    }
}

function editProduct(index) {
    const p = products[index];
    form.elements.name.value = p.name;
    form.elements.element.value = p.element;
    form.elements.price.value = p.price;
    form.elements.image.value = p.image;
    products.splice(index, 1);
    renderProducts();
}

renderProducts();