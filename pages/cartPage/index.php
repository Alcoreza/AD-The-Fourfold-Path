<?php require_once dirname(__DIR__, 2) . '/bootstrap.php'; ?> <!-- [QA] add a named custom path -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cart | Avatar Market</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caudex&family=Uncial+Antiqua&display=swap" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
    <link href="/pages/cartPage/assets/css/cart.css" rel="stylesheet">
</head>

<body>
    <?php include COMPONENTS_PATH . '/navbar.component.php'; ?>

    <div class="cart-container">
        <h1>Your Elemental Cart</h1>

        <div id="cart-empty" class="empty-cart">
            <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" alt="Empty Cart Icon" />
            <p>Your cart is still empty... summon a product!</p>
        </div>

        <div id="cart-items" class="cart-items" style="display: none;"></div>

        <div class="checkout" id="checkout-section" style="display: none;">
            <button class="btn">Proceed to Checkout</button>
        </div>
    </div>

    <?php include COMPONENTS_PATH . '/footer.component.php'; ?>
    <script src="/pages/cartPage/assets/js/cart.js"></script>
</body>

</html>