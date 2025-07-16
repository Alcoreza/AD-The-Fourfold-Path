<nav class="navbar">
    <div class="nav-brand">
        <a href="/index.php" class="nav-brand-link">
            <img src="/assets/img/favicon/favicon1.png" alt="The Fourfold Path Logo" class="nav-logo">
            <span>The Fourfold Path</span>
        </a>
    </div>
    <ul class="nav-links">
        <li><a href="/index.php">Home</a></li>
        <li><a href="/pages/productPage/index.php">Products</a></li>
        <li><a href="/pages/cartPage/index.php">Cart</a></li>
        <li><a href="/pages/aboutPage/index.php">About</a></li>

        <?php if (isset($_SESSION['user'])): ?>
            <li class="nav-welcome">Welcome, <?= htmlspecialchars($_SESSION['user']['username']) ?>!</li>
            <li><a href="/handlers/logoutUser.handler.php">Logout</a></li>
        <?php else: ?>
            <li><a href="/pages/loginPage/index.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>