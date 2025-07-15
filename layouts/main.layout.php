<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Fourfold Path</title>
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/styles.css">

    <?php if (isset($pageName) && $pageName === 'about'): ?>
        <link rel="stylesheet" href="/pages/aboutPage/assets/css/about.css">
    <?php endif; ?>
</head>
<body>

<?php
// ✅ HEADER
if (isset($headerType) && $headerType === 'product') {
    require_once COMPONENTS_PATH . '/productHeader.component.php';
} else {
    require_once COMPONENTS_PATH . '/header.component.php';
}

// ✅ NAVBAR
if (isset($navbarType) && $navbarType === 'admin') {
    require_once COMPONENTS_PATH . '/adminNavbar.component.php';
} else {
    require_once COMPONENTS_PATH . '/navbar.component.php';
}
?>

<main class="container">
    <?php if (isset($content)) echo $content; ?>
</main>

<?php require_once COMPONENTS_PATH . '/footer.component.php'; ?>

<?php if (isset($pageName) && $pageName === 'about'): ?>
    <script src="/pages/aboutPage/assets/js/about.js"></script>
<?php endif; ?>

</body>
</html>
