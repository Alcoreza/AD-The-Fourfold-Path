<?php
require_once COMPONENTS_PATH . '/header.component.php';
require_once COMPONENTS_PATH . '/navbar.component.php';
?>

<main class="container">
    <?php if (isset($content)) echo $content; ?>
</main>

<?php require_once COMPONENTS_PATH . '/footer.component.php' ?>