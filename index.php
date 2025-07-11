<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Fourfold Path</title>
    <link href="/assets/css/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">
</head>

<!-- [QA] use components for the navbar -->

<body>
    <!-- [QA] adjust the spacing for the navbar -->
    <nav class="navbar">
        <div class="nav-brand">The Fourfold Path</div>
        <ul class="nav-links">
            <li><a href="/index.php">Home</a></li>
            <li><a href="/pages/productPage/index.php">Products</a></li>
            <li><a href="/pages/aboutPage/index.php">About</a></li>
            <li><a href="/pages/loginPage/index.php">Login</a></li>
        </ul>
    </nav>

    <header class="hero">
        <h1>The Fourfold Path</h1>
        <p class="tagline">Harness the Elements. Master Your Energy.</p>
    </header>

    <main class="fade-in-section">
        <section class="intro-section">
            <h2>Welcome, Bender</h2>
            <p>
                Here at The Fourfold Path, we believe the spirit of each element lives within all of us. Our elemental
                gear is inspired by the traditions of the Four Nations - Fire, Water, Air, and Earth.<br>
                Crafted to help you connect with your inner strength.
            </p>
            <p>
                Whether you seek to train your body, relax your soul, or wear your nation’s pride,<br>
                our collection is the beginning of your journey.
            </p>
            <p>
                Choose wisely. Train with purpose. Master your path.
            </p>
            <a href="/pages/products.php" class="explore-btn">Explore Products</a>
        </section>
    </main>

    <section class="element-cards">
        <h2>Choose Your Nation</h2>
        <div class="card-grid">
            <div class="card fire fade-in-section">
                <h3>Fire Nation</h3>
                <p class="description">Power, precision, and relentless drive. Harness the heat within.</p>
            </div>
            <div class="card water fade-in-section">
                <h3>Water Tribe</h3>
                <p class="description">Healing, balance, and flow. Master the art of adaptation.</p>
            </div>
            <div class="card air fade-in-section">
                <h3>Air Nomads</h3>
                <p class="description">Freedom, peace, and motion. Glide lightly through the world.</p>
            </div>
            <div class="card earth fade-in-section">
                <h3>Earth Kingdom</h3>
                <p class="description">Stability, resilience, and power. Stand your ground with strength.</p>
            </div>
        </div>
    </section>

    <footer class="site-footer">
        <div class="footer-brand">The Fourfold Path</div>
        <p class="copyright">
            © 2025 The Fourfold Path. Crafted with balance and harmony.
        </p>
    </footer>

    <script src="assets/js/scripts.js"></script>
</body>

</html>