<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | The Fourfold Path' : 'The Fourfold Path' ?></title>
    <link rel="stylesheet" href="/assets/css/errors.css">
    <link href="https://fonts.googleapis.com/css2?family=Caudex:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="error-page">

    <?= isset($content) ? $content : '<p>Oops! No content loaded.</p>' ?>

</body>
</html>
