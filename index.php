<?php
require_once HANDLERS_PATH . '/postgreChecker.handler.php';
require_once HANDLERS_PATH . '/mongodbChecker.handler.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Fourfold Path</title>
    <link href="/pages/homePage/assets/css/styles.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">
</head>
<body>

    <nav class="navbar">
        <div class="nav-brand">The Fourfold Path</div>
        <ul class="nav-links">
            <li><a href="/pages/homePage/index.php">Home</a></li>
            <li><a href="/pages/productPage/index.php">Products</a></li>
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
                Here at The Fourfold Path, we believe the spirit of each element lives within all of us. Our elemental gear is inspired by the traditions of the Four Nations - Fire, Water, Air, and Earth.<br>
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

    