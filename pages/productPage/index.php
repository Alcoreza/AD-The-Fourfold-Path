<?php require_once dirname(__DIR__, 2) . '/bootstrap.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Element-Themed Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Caudex&family=Uncial+Antiqua&display=swap" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
    <link href="/pages/productPage/assets/css/product.css" rel="stylesheet">
</head>
<body>
    <?php include COMPONENTS_PATH . '/navbar.component.php'; ?>

    <header class="banner">
        <img src="/assets/img/banner.jpg" alt="Element Products Banner">
        <div class="banner-text">
            <h1>All Products</h1>
        </div>
    </header>

    <div class="container">
        <div class="category-labels">
            <button class="label fire" onclick="filterProducts('fire')">🔥 Fire Nation</button>
            <button class="label water" onclick="filterProducts('water')">🌊 Water Tribe</button>
            <button class="label air" onclick="filterProducts('air')">🌪️ Air Nomads</button>
            <button class="label earth" onclick="filterProducts('earth')">🌍 Earth Kingdom</button>
            <button class="label all" onclick="filterProducts('all')">🌐 All</button>
        </div>

        <div class="product-section fire">
            <h2>🔥 Fire Nation</h2>
            <div class="product-grid">
                <div class="product-card">
                    <div class="product-title">Agni Gloves</div>
                    <div class="product-desc">Fire-resistant gloves for precision bending drills.</div>
                </div>
                <div class="product-card">
                    <div class="product-title">Sozin’s Brew</div>
                    <div class="product-desc">Spicy herbal tea said to ignite inner fire.</div>
                </div>
                <div class="product-card">
                    <div class="product-title">Blazing Scrolls</div>
                    <div class="product-desc">Training scrolls with advanced firebending forms.</div>
                </div>
                <div class="product-card">
                    <div class="product-title">Inferno Band</div>
                    <div class="product-desc">A sleek wristband that radiates heat and passion.</div>
                </div>
            </div>
        </div>

        <div class="product-section water">
            <h2>🌊 Water Tribe</h2>
            <div class="product-grid">
                <div class="product-card">
                    <div class="product-title">Healing Salts</div>
                    <div class="product-desc">Bath salts inspired by Northern Tribe traditions.</div>
                </div>
                <div class="product-card">
                    <div class="product-title">Tide Gloves</div>
                    <div class="product-desc">Water-repellent gloves designed for fluid movement.</div>
                </div>
                <div class="product-card">
                    <div class="product-title">Moon & Ocean Necklace</div>
                    <div class="product-desc">Jewelry representing push/pull waterbending.</div>
                </div>
                <div class="product-card">
                    <div class="product-title">Glacial Flask</div>
                    <div class="product-desc">Thermos that keeps drinks icy like the South Pole.</div>
                </div>
            </div>
        </div>

        <div class="product-section air">
            <h2>🌪️ Air Nomads</h2>
            <div class="product-grid">
                <div class="product-card">
                    <div class="product-title">Whirling Staff Replica</div>
                    <div class="product-desc">Lightweight airbender staff prop.</div>
                </div>
                <div class="product-card">
                    <div class="product-title">Monk Gyatso’s Incense</div>
                    <div class="product-desc">Aromatherapy for calm and meditation.</div>
                </div>
                <div class="product-card">
                    <div class="product-title">Glider Pouch</div>
                    <div class="product-desc">Compact satchel inspired by airbender travel gear.</div>
                </div>
                <div class="product-card">
                    <div class="product-title">Air Meditation Mat</div>
                    <div class="product-desc">Soft cotton mat perfect for stillness and focus.</div>
                </div>
            </div>
        </div>

        <div class="product-section earth">
            <h2>🌍 Earth Kingdom</h2>
            <div class="product-grid">
                <div class="product-card">
                    <div class="product-title">Ba Sing Se Sandals</div>
                    <div class="product-desc">Sturdy shoes inspired by Earth Kingdom warriors.</div>
                </div>
                <div class="product-card">
                    <div class="product-title">Tremor Stones</div>
                    <div class="product-desc">Weighted training tools for stances.</div>
                </div>
                <div class="product-card">
                    <div class="product-title">Metalbender Armbands</div>
                    <div class="product-desc">Fashionable cuffs symbolizing strength.</div>
                </div>
                <div class="product-card">
                    <div class="product-title">Dust Trail Satchel</div>
                    <div class="product-desc">Earth-toned bag for grounded journeys.</div>
                </div>
            </div>
        </div>
    </div>

    <?php include COMPONENTS_PATH . '/footer.component.php'; ?>

    <script src="/pages/productPage/assets/js/product.js"></script>
</body>
</html>