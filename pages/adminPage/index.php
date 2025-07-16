<?php
require_once '../../bootstrap.php';
require_once UTILS_PATH . 'admin.util.php';

$pageTitle = 'Admin Dashboard';
$pageName = 'admin';
$navbarType = 'admin';
$headerType = 'none';

$products = getAllProducts();
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

<section class="admin-card">
    <div class="admin-card-header">Add New Product</div>
    <div class="admin-card-body">
        <form id="productForm" class="admin-form" method="POST" action="/handlers/admin.handler.php">
            <input type="hidden" name="action" value="add">
            <input type="text" placeholder="Product Name" name="name" required>
            <input type="number" placeholder="Price (₱)" name="price" required>
            <input type="url" placeholder="Image URL" name="image_url">
            <input type="number" placeholder="Stock Quantity" name="stock_quantity" required>
            <textarea name="description" placeholder="Product Description" rows="2"
                style="width: 100%; padding: 10px; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; resize: vertical; font-family: inherit;"></textarea>
            <div style="display: flex; justify-content: center; margin-top: 10px;">
                <button type="submit" class="admin-btn">Add Product</button>
            </div>
        </form>
    </div>
</section>

<!-- Product List Output -->
<section id="productList" class="product-list-section">
    <?php foreach ($products as $item): ?>
        <div class="product-card show">
            <?php if (!empty($item['image_url'])): ?>
                <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>"
                    style="width: 100%; max-height: 220px; object-fit: cover; border-radius: 8px; margin-bottom: 10px;">
            <?php endif; ?>
            <form method="POST" action="/handlers/admin.handler.php" class="admin-form" style="margin-bottom:0;">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="item_id" value="<?= $item['item_id'] ?>">
                <input type="text" name="name" value="<?= htmlspecialchars($item['name']) ?>" required>
                <input type="number" name="price" value="<?= $item['price'] ?>" required>
                <input type="url" name="image_url" value="<?= htmlspecialchars($item['image_url']) ?>">
                <input type="number" name="stock_quantity" value="<?= $item['stock_quantity'] ?>" required>
                <textarea name="description" placeholder="Description"
                    style="width: 100%; font-size: 14px; border: 1px solid #ccc; border-radius: 4px; resize: vertical; font-family: inherit;"><?= htmlspecialchars($item['description'] ?? '') ?></textarea>
                <div style="display: flex; gap: 10px; margin-top: 10px;">
                    <button type="submit" class="add-to-cart-btn">Save</button>
                </div>
            </form>
            <form method="POST" action="/handlers/admin.handler.php" style="display:inline;">
                <input type="hidden" name="action" value="delete">
                <input type="hidden" name="item_id" value="<?= $item['item_id'] ?>">
                <button type="submit" class="add-to-cart-btn delete-btn" style="background-color: #a82a2a; text-align: center; margin-top: 5px;" onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
       </a>
                </div>
            </form>
        </div>
    <?php endforeach; ?>
</section>

<?php
$content = ob_get_clean();
require_once LAYOUT_PATH . '/admin.layout.php';
?>
