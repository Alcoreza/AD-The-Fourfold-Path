<?php require_once dirname(__DIR__, 2) . '/bootstrap.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | The Fourfold Path</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Caudex&family=Uncial+Antiqua&display=swap" rel="stylesheet">
    <link href="/assets/css/styles.css" rel="stylesheet">
    <link href="/pages/productPage/assets/css/product.css" rel="stylesheet">
</head>

<body>
    <?php
    include COMPONENTS_PATH . '/navbar.component.php';
    include COMPONENTS_PATH . '/productHeader.component.php';
    ?>
    <!-- [QA] kindly add animations when scrolling -->
    <div class="product-wrapper">
        <div class="container">
            <div class="category-labels">
                <img src="/assets/img/fire.png" alt="Fire Nation" class="faction-icon" onclick="filterProducts('fire')">
                <img src="/assets/img/water.png" alt="Water Tribe" class="faction-icon"
                    onclick="filterProducts('water')">
                <img src="/assets/img/air.png" alt="Air Nomads" class="faction-icon" onclick="filterProducts('air')">
                <img src="/assets/img/earth.png" alt="Earth Kingdom" class="faction-icon"
                    onclick="filterProducts('earth')">
                <img src="/assets/img/allButton.png" alt="All Products" class="faction-icon"
                    onclick="filterProducts('all')">
            </div>

            <?php
            $productsByNation = [
                'fire' => [
                    'title' => 'Fire Nation',
                    'items' => [
                        ["Agni Drill Gloves", "Specialized fire-resistant gloves for breathing synchronization and strike training.", "agniGloves.png", 1999.00],
                        ["Breath of Sozin Mask", "A martial arts breathing mask infused with warming herbs.", "sozinMask.png", 1499.00],
                        ["Blazing Kata Scrolls", "Advanced firebending sequences for agility, footwork, and controlled bursts.", "blazingScrolls.png", 999.00],
                        ["Flame Arc Bands", "Wrist bands weighted for training rapid strikes and whip motions.", "flameBands.png", 1249.00],
                        ["Dancing Dragon Silks", "Traditional practice robes for dual form routines.", "dragonSilk.png", 2499.00],
                        ["Inferno Training Mat", "High-grip mat with flame-flow pattern to guide stance work.", "infernoMat.png", 2499.00],
                    ]
                ],
                'water' => [
                    'title' => 'Water Tribe',
                    'items' => [
                        ["Flowform Sash", "A cloth band worn around the waist for balance and motion awareness.", "flowformSash.png", 1499.00],
                        ["Moon Pull Stones", "Two small orbs used to train fluid wrist and arm rotations.", "moonStones.png", 749.00],
                        ["Tidal Stance Pads", "Soft training pads placed under feet for shifting and sliding exercises.", "stancePads.png", 1199.00],
                        ["Spirit Current Wraps", "Arm wraps infused with sea salt and lavender for calming flow practice.", "currentWraps.png", 799.00],
                        ["Healing Circle Mat", "A reflective training mat used in group bending drills or healing rituals.", "healingMat.png", 2199.00],
                        ["Glacial Edge Fan", "A lightweight practice fan used to simulate ice slicing and wave forms.", "glacialFan.png", 1299.00],
                    ]
                ],
                'air' => [
                    'title' => 'Air Nomads',
                    'items' => [
                        ["Spiral Motion Bands", "Elastic training bands used to encourage wide circular movements.", "spiralBands.png", 1599.00],
                        ["Whisper Cloak", "Extremely lightweight hooded robe that responds to movement and airflow.", "whisperCloak.png", 3000.00],
                        ["Cyclone Steps Mat", "A circular footwork mat used to train directional change and evasion.", "cycloneMat.png", 1899.00],
                        ["Monk Gyatso’s Breath Bell", "A bell that rings only with steady exhalation through a breathing tube.", "monkBell.png", 1199.00],
                        ["Glider Staff Trainer", "A shortened, padded version of the iconic glider staff.", "gliderStaff.png", 1699.00],
                        ["Void Meditation Orb", "A lightweight sphere used during balance meditation and Ba Gua circles.", "voidOrb.png", 999.00],
                    ]
                ],
                'earth' => [
                    'title' => 'Earth Kingdom',
                    'items' => [
                        ["Tremor Grounding Sandals", "Weighted shoes designed to enhance stance practice and earth connection.", "tremorSandals.png", 2099.00],
                        ["Stone Core Belt", "A training belt that provides feedback on hip alignment during stances.", "stoneBelt.png", 1599.00],
                        ["Seismic Focus Rods", "Handheld rods for training punching accuracy and resistance.", "seismicRods.png", 1199.00],
                        ["Pillar Stance Board", "A rigid board with stone patterns to guide foot spacing.", "pillarStance.png", 1499.00],
                        ["Ironroot Arm Weights", "Forearm bands with internal sand-fill for slow, controlled bending drills.", "ironroot.png", 1399.00],
                        ["Badgermole Rhythm Drum", "A pulse drum used during seismic sensing and earth-rhythm meditation.", "badgermole.png", 1299.00],
                    ]
                ]
            ];

            foreach ($productsByNation as $nation => $data):
                ?>
                <div class="product-section <?= $nation ?>">
                    <h2><?= htmlspecialchars($data['title']) ?></h2>
                    <div class="product-grid">
                        <?php foreach ($data['items'] as [$title, $desc, $img, $price]): ?>
                            <div class="product-card">
                                <img src="/assets/img/products/<?= $nation ?>/<?= $img ?>"
                                    alt="<?= htmlspecialchars($title) ?>">
                                <div class="product-title"><?= htmlspecialchars($title) ?></div>
                                <div class="product-desc"><?= htmlspecialchars($desc) ?></div>
                                <div class="product-price">₱<?= number_format($price, 2) ?></div>
                                <button class="add-to-cart-btn" data-title="<?= htmlspecialchars($title) ?>"
                                    data-price="<?= number_format($price, 2) ?>"
                                    data-image="/assets/img/products/<?= $nation ?>/<?= $img ?>" data-nation="<?= $nation ?>">
                                    <i class="fas fa-cart-plus"></i> Add to Cart
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php include COMPONENTS_PATH . '/footer.component.php'; ?>
        <script src="/pages/productPage/assets/js/product.js"></script>
    </div>
</body>

</html>