<?php require_once dirname(__DIR__, 2) . '/bootstrap.php'; ?> <!-- [QA] add a named custom path -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin | Manage Avatar Gear</title>
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&family=Caudex&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="/pages/adminPage/assets/css/admin.css">
    <link rel="stylesheet" href="/pages/productPage/assets/css/product.css">
</head>

<body>

    <?php include COMPONENTS_PATH . '/adminNavbar.component.php'; ?>

    <main class="admin-container">
        <h2 class="admin-title">Admin Dashboard – Avatar Gear</h2>

        <!-- Filter Section -->
        <div class="admin-filter-wrapper">
            <select id="elementFilter" class="element-filter">
                <option value="all">All Nations</option>
                <option value="fire">🔥 Fire Nation</option>
                <option value="water">💧 Water Tribe</option>
                <option value="earth">🌿 Earth Kingdom</option>
                <option value="air">🌬 Air Nomads</option>
            </select>
        </div>

        <!-- Add Product Form -->
        <section class="admin-card">
            <div class="admin-card-header">Add New Product</div>
            <div class="admin-card-body">
                <form id="productForm" class="admin-form">
                    <input type="text" placeholder="Product Name" name="name" required>
                    <select name="element" required>
                        <option value="">Element</option>
                        <option value="fire">Fire</option>
                        <option value="water">Water</option>
                        <option value="earth">Earth</option>
                        <option value="air">Air</option>
                    </select>
                    <input type="number" placeholder="Price (₱)" name="price" required>
                    <input type="url" placeholder="Image URL" name="image" required>
                    <button type="submit" class="admin-btn">Add Product</button>
                </form>
            </div>
        </section>

        <!-- Product List -->
        <section id="productList" class="product-list-section">
            <!-- Products will load here -->
        </section>
    </main>

    <?php include COMPONENTS_PATH . "/footer.component.php"; ?>
    <script src="/pages/adminPage/assets/js/admin.js"></script>
</body>

</html>