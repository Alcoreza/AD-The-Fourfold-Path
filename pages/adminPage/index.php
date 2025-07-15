<?php
require_once '../../bootstrap.php';

$pageTitle = 'Admin Dashboard';
$pageName = 'admin';
$navbarType = 'admin';
$headerType = 'none';

ob_start();
?>

<h2 class="admin-title">Admin Dashboard – Avatar Gear</h2>

<!-- Filter Dropdown -->
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

<!-- Product List Output -->
<section id="productList" class="product-list-section">
    <!-- Dynamically loaded via JS -->
</section>

<?php
$content = ob_get_clean();
require_once LAYOUT_PATH . '/admin.layout.php';