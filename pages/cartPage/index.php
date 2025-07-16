<?php
require_once '../../bootstrap.php';
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
        <div id="cart-empty" class="empty-cart">
            <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Empty Cart Icon" />
            <p>Your cart is still empty... summon a product!</p>
        </div>
    <?php else: ?>
        <div id="cart-items" class="cart-items">
            <?php foreach ($cartItems as $item): ?>
                <div class="cart-card" data-cart-item-id="<?= $item['cart_item_id'] ?>" data-price="<?= $item['price'] ?>">

                    <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
                    <div class="cart-info">
                        <h3><?= htmlspecialchars($item['name']) ?></h3>
                        <p>Price: ₱<?= number_format($item['price'], 2) ?></p>

                        <div class="quantity-controls">
                            <button type="button" class="qty-btn" data-action="minus">−</button>
                            <span class="qty"><?= $item['quantity'] ?></span>
                            <button type="button" class="qty-btn" data-action="plus">+</button>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="checkout-section" class="checkout">
            <button class="btn">Finish Order</button>
        </div>
    <?php endif; ?>
</div>

<?php
$content = ob_get_clean();
include LAYOUT_PATH . '/main.layout.php';