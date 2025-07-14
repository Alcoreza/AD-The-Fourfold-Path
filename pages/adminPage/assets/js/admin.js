const productList = document.getElementById("productList");
const form = document.getElementById("productForm");
const filter = document.getElementById("elementFilter");
let products = [];

// TEMP DUMMY DATA (REPLACE THIS AFTER BACK-END INTEGRATION)
products = [
    { name: "Agni Drill Gloves", element: "fire", price: 1999, image: "/assets/img/products/fire/agniGloves.png" },
    { name: "Breath of Sozin Mask", element: "fire", price: 1499, image: "/assets/img/products/fire/sozinMask.png" },
    { name: "Blazing Kata Scrolls", element: "fire", price: 999, image: "/assets/img/products/fire/blazingScrolls.png" },
    { name: "Flame Arc Bands", element: "fire", price: 1249, image: "/assets/img/products/fire/flameBands.png" },
    { name: "Dancing Dragon Silks", element: "fire", price: 2499, image: "/assets/img/products/fire/dragonSilk.png" },
    { name: "Inferno Training Mat", element: "fire", price: 2499, image: "/assets/img/products/fire/infernoMat.png" },

    { name: "Flowform Sash", element: "water", price: 1499, image: "/assets/img/products/water/flowformSash.png" },
    { name: "Moon Pull Stones", element: "water", price: 749, image: "/assets/img/products/water/moonStones.png" },
    { name: "Tidal Stance Pads", element: "water", price: 1199, image: "/assets/img/products/water/stancePads.png" },
    { name: "Spirit Current Wraps", element: "water", price: 799, image: "/assets/img/products/water/currentWraps.png" },
    { name: "Healing Circle Mat", element: "water", price: 2199, image: "/assets/img/products/water/healingMat.png" },
    { name: "Glacial Edge Fan", element: "water", price: 1299, image: "/assets/img/products/water/glacialFan.png" },

    { name: "Spiral Motion Bands", element: "air", price: 1599, image: "/assets/img/products/air/spiralBands.png" },
    { name: "Whisper Cloak", element: "air", price: 3000, image: "/assets/img/products/air/whisperCloak.png" },
    { name: "Cyclone Steps Mat", element: "air", price: 1899, image: "/assets/img/products/air/cycloneMat.png" },
    { name: "Monk Gyatso’s Breath Bell", element: "air", price: 1199, image: "/assets/img/products/air/monkBell.png" },
    { name: "Glider Staff Trainer", element: "air", price: 1699, image: "/assets/img/products/air/gliderStaff.png" },
    { name: "Void Meditation Orb", element: "air", price: 999, image: "/assets/img/products/air/voidOrb.png" },

    { name: "Tremor Grounding Sandals", element: "earth", price: 2099, image: "/assets/img/products/earth/tremorSandals.png" },
    { name: "Stone Core Belt", element: "earth", price: 1599, image: "/assets/img/products/earth/stoneBelt.png" },
    { name: "Seismic Focus Rods", element: "earth", price: 1199, image: "/assets/img/products/earth/seismicRods.png" },
    { name: "Pillar Stance Board", element: "earth", price: 1499, image: "/assets/img/products/earth/pillarStance.png" },
    { name: "Ironroot Arm Weights", element: "earth", price: 1399, image: "/assets/img/products/earth/ironroot.png" },
    { name: "Badgermole Rhythm Drum", element: "earth", price: 1299, image: "/assets/img/products/earth/badgermole.png" }
];

function renderProducts() {
    const filterValue = filter.value;
    productList.innerHTML = "";

    products
        .filter(p => filterValue === "all" || p.element === filterValue)
        .forEach((product, index) => {
            const card = document.createElement("div");
            card.className = "product-card show";

            card.innerHTML = `
                <img src="${product.image}" alt="${product.name}" style="width: 100%; max-height: 220px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
                <h3 class="product-title">${product.name}</h3>
                <p class="product-desc"><strong>Nation:</strong> ${product.element}</p>
                <p class="product-price">₱${product.price}</p>
                <div style="display: flex; gap: 10px; margin-top: 10px;">
                    <button class="add-to-cart-btn" onclick="editProduct(${index})">Edit</button>
                    <button class="add-to-cart-btn" style="background-color: #a82a2a;" onclick="deleteProduct(${index})">Delete</button>
                </div>
            `;

            productList.appendChild(card);
        });
}

form.addEventListener("submit", function (e) {
    e.preventDefault();
    const formData = new FormData(form);
    const newProduct = Object.fromEntries(formData);
    newProduct.price = parseFloat(newProduct.price); // ensure price is a number
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

// Initial render
renderProducts();