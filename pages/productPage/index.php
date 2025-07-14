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

    <div class="product-wrapper"> <!-- [QA] add the fixed shadow -->
        <!-- [QA] when hovering make the lift effect more like a glow (e.g. gold color) instead of a shadow effect -->
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

            <!-- Fire Nation Products -->
            <div class="product-section fire">
                <h2>Fire Nation</h2>
                <div class="product-grid">
                    <?php $fireProducts = [
                        ["Agni Drill Gloves", "Specialized fire-resistant gloves for breathing synchronization and strike training.", "agniGloves.png"],
                        ["Breath of Sozin Mask", "A martial arts breathing mask infused with warming herbs.", "sozinMask.png"],
                        ["Blazing Kata Scrolls", "Advanced firebending sequences for agility, footwork, and controlled bursts.", "blazingScrolls.png"],
                        ["Flame Arc Bands", "Wrist bands weighted for training rapid strikes and whip motions.", "flameBands.png"],
                        ["Dancing Dragon Silks", "Traditional practice robes for dual form routines.", "dragonSilk.png"],
                        ["Inferno Training Mat", "High-grip mat with flame-flow pattern to guide stance work.", "infernoMat.png"]
                    ];
                    foreach ($fireProducts as [$title, $desc, $img]) {
                        echo "<div class='product-card'>
                            <img src='/assets/img/products/fire/$img' alt='$title'>
                            <div class='product-title'>$title</div>
                            <div class='product-desc'>$desc</div>
                        </div>";
                    }
                    ?>
                </div>
            </div>

            <!-- Water Tribe Products -->
            <div class="product-section water">
                <h2>Water Tribe</h2>
                <div class="product-grid">
                    <?php $waterProducts = [
                        ["Flowform Sash", "A cloth band worn around the waist for balance and motion awareness.", "flowformSash.png"],
                        ["Moon Pull Stones", "Two small orbs used to train fluid wrist and arm rotations.", "moonStones.png"],
                        ["Tidal Stance Pads", "Soft training pads placed under feet for shifting and sliding exercises.", "stancePads.png"],
                        ["Spirit Current Wraps", "Arm wraps infused with sea salt and lavender for calming flow practice.", "currentWraps.png"],
                        ["Healing Circle Mat", "A reflective training mat used in group bending drills or healing rituals.", "healingMat.png"],
                        ["Glacial Edge Fan", "A lightweight practice fan used to simulate ice slicing and wave forms.", "glacialFan.png"]
                    ];
                    foreach ($waterProducts as [$title, $desc, $img]) {
                        echo "<div class='product-card'>
                            <img src='/assets/img/products/water/$img' alt='$title'>
                            <div class='product-title'>$title</div>
                            <div class='product-desc'>$desc</div>
                        </div>";
                    }
                    ?>
                </div>
            </div>

            <!-- Air Nomads Products -->
            <div class="product-section air">
                <h2>Air Nomads</h2>
                <div class="product-grid">
                    <?php $airProducts = [
                        ["Spiral Motion Bands", "Elastic training bands used to encourage wide circular movements.", "spiralBands.png"],
                        ["Whisper Cloak", "Extremely lightweight hooded robe that responds to movement and airflow.", "whisperCloak.png"],
                        ["Cyclone Steps Mat", "A circular footwork mat used to train directional change and evasion.", "cycloneMat.png"],
                        ["Monk Gyatso’s Breath Bell", "A bell that rings only with steady exhalation through a breathing tube.", "monkBell.png"],
                        ["Glider Staff Trainer", "A shortened, padded version of the iconic glider staff.", "gliderStaff.png"],
                        ["Void Meditation Orb", "A lightweight sphere used during balance meditation and Ba Gua circles.", "voidOrb.png"]
                    ];
                    foreach ($airProducts as [$title, $desc, $img]) {
                        echo "<div class='product-card'>
                            <img src='/assets/img/products/air/$img' alt='$title'>
                            <div class='product-title'>$title</div>
                            <div class='product-desc'>$desc</div>
                        </div>";
                    }
                    ?>
                </div>
            </div>

            <!-- Earth Kingdom Products -->
            <div class="product-section earth">
                <h2>Earth Kingdom</h2>
                <div class="product-grid">
                    <?php $earthProducts = [
                        ["Tremor Grounding Sandals", "Weighted shoes designed to enhance stance practice and earth connection.", "tremorSandals.png"],
                        ["Stone Core Belt", "A training belt that provides feedback on hip alignment during stances.", "stoneBelt.png"],
                        ["Seismic Focus Rods", "Handheld rods for training punching accuracy and resistance.", "seismicRods.png"],
                        ["Pillar Stance Board", "A rigid board with stone patterns to guide foot spacing.", "pillarStance.png"],
                        ["Ironroot Arm Weights", "Forearm bands with internal sand-fill for slow, controlled bending drills.", "ironroot.png"],
                        ["Badgermole Rhythm Drum", "A pulse drum used during seismic sensing and earth-rhythm meditation.", "badgermole.png"]
                    ];
                    foreach ($earthProducts as [$title, $desc, $img]) {
                        echo "<div class='product-card'>
                            <img src='/assets/img/products/earth/$img' alt='$title'>
                            <div class='product-title'>$title</div>
                            <div class='product-desc'>$desc</div>
                        </div>";
                    }
                    ?>
                </div>
            </div>
        </div>

        <?php include COMPONENTS_PATH . '/footer.component.php'; ?>
        <script src="/pages/productPage/assets/js/product.js"></script>
</body>

</html>