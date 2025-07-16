<?php
require_once dirname(__DIR__, 2) . '/bootstrap.php';
require_once UTILS_PATH . 'cartItems.util.php';

$pageTitle = 'Cart';
$pageName = 'cart';
$navbarType = 'default';
$headerType = 'none';

$userId = $_SESSION['user']['id'] ?? null;
$cartItems = [];

if ($userId) {
    $cartItems = fetchCartItems($userId);
}

ob_start();
?>

<div class="cart-container">
    <h1>Your Elemental Cart</h1>

    <?php if (empty($cartItems)): ?>
        <div class="empty-cart">
            <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Empty Cart Icon" />
            <p>Your cart is still empty... summon a product!</p>
        </div>
    <?php else: ?>
        <div class="cart-items">
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-card">
                    <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                    <div class="cart-info">
                        <h3><?= htmlspecialchars($item['name']) ?></h3>
                        <p>Price: ₱<?= number_format($item['price'], 2) ?></p>
                        <form method="POST" action="/handlers/cartItems.handler.php">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="cart_item_id" value="<?= $item['cart_item_id'] ?>">
                            <div class="quantity-control">
                                <button type="submit" name="quantity" value="<?= max(1, $item['quantity'] - 1) ?>">-</button>
                                <input type="number" name="quantity" value="<?= $item['quantity'] ?>" min="1">
                                <button type="submit" name="quantity" value="<?= $item['quantity'] + 1 ?>">+</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="checkout">
            <button class="btn">Proceed to Checkout</button>
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include LAYOUT_PATH . '/main.layout.php';
