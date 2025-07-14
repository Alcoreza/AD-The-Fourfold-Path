<?php require_once dirname(__DIR__, 2) . '/bootstrap.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | Manage Avatar Gear</title>
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&family=Caudex&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Uncial+Antiqua&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/styles.css">
    <link rel="stylesheet" href="/pages/adminPage/assets/css/admin.css">
    <link rel="stylesheet" href="/pages/productPage/assets/css/product.css">
</head>
<body>

<?php
    include COMPONENTS_PATH . '/adminNavbar.component.php';
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Admin Dashboard – Avatar Gear</h2>

<!-- Filter -->
    <div class="row mb-4">
        <div class="col-md-4 offset-md-4">
        <select id="elementFilter" class="form-select">
            <option value="all">All Nations</option>
            <option value="fire">🔥 Fire Nation</option>
            <option value="water">💧 Water Tribe</option>
            <option value="earth">🌿 Earth Kingdom</option>
            <option value="air">🌬 Air Nomads</option>
        </select>
        </div>
    </div>

    <!-- Add Product -->
    <div class="card mb-5">
        <div class="card-header bg-dark text-white">Add New Product</div>
        <div class="card-body">
        <form id="productForm" class="row g-3">
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Product Name" name="name" required>
            </div>
            <div class="col-md-2">
            <select class="form-select" name="element" required>
                <option value="">Element</option>
                <option value="fire">Fire</option>
                <option value="water">Water</option>
                <option value="earth">Earth</option>
                <option value="air">Air</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" class="form-control" placeholder="Price (₱)" name="price" required>
        </div>
        <div class="col-md-3">
            <input type="url" class="form-control" placeholder="Image URL" name="image" required>
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-success">Add Product</button>
        </div>
        </form>
        </div>
    </div>

    <!-- Product List -->
    <div class="row" id="productList"></div>
</div>

<script src="/pages/adminPage/assets/js/admin.js"></script>
</body>
</html>