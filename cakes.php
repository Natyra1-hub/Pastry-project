<?php
session_start(); 
require_once 'Database.php'; 

$db = new Database();
$pdo = $db->getConnection();

if (isset($_POST['add_to_cart'])) {
    $item = [
        'id' => $_POST['id'],
        'emri' => $_POST['emri'],
        'cmimi' => $_POST['cmimi']
    ];
    
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    
    $_SESSION['cart'][] = $item;

    
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        echo count($_SESSION['cart']);
        exit; 
    }

    header("Location: cakes.php"); 
    exit();
}


$queryCakes = "SELECT * FROM cakes LIMIT 8";
$stmtCakes = $pdo->prepare($queryCakes);
$stmtCakes->execute();
$cakes = $stmtCakes->fetchAll(PDO::FETCH_ASSOC);

$queryBday = "SELECT * FROM birthday_cakes LIMIT 8";
$stmtBday = $pdo->prepare($queryBday);
$stmtBday->execute();
$bday_cakes = $stmtBday->fetchAll(PDO::FETCH_ASSOC);

$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetCakes - Menu</title>
    <link rel="stylesheet" href="cakes.css">
    <style>
        .shopping-cart-container { position: relative; display: inline-block; }
        .cart-count-badge {
            position: absolute; top: -5px; right: -5px;
            background: red; color: white; border-radius: 50%;
            padding: 2px 7px; font-size: 12px; font-weight: bold;
            border: 2px solid white;
        }
        .add-cart-btn {
            background-color: #ff69b4; color: white; border: none;
            padding: 8px 12px; cursor: pointer; border-radius: 5px;
            margin-top: 10px; font-size: 14px; transition: 0.3s; width: 100%;
        }
        .add-cart-btn:hover { background-color: #ff1493; }
        .menu_info h3 { margin-bottom: 5px; }
    </style>
</head>
<body>
    <section id="Cakes">
        <nav>
            <div class="logo">
                <img src="offerspage/Logo.png" alt="Logo">
            </div>
            <ul>
                <li><a href="pastry.php">Home</a></li>
                <li><a href="cakes.php">Cakes</a></li>
                <li><a href="offers.php">Offers</a></li>
                <li><a href="build.php">Build your own</a></li>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <li><a href="logout.php">Log Out</a></li>
                <?php else: ?>
                    <li><a href="loginpage.php">Login</a></li>
                <?php endif; ?>
            </ul>

            <a href="porosite.php" class="shopping-cart-container" id="cart-anchor">
                <img src="homepage/Screenshot 2025-12-15 193709.png" alt="Shporta" width="50">
                <span class="cart-count-badge" id="cart-count" style="<?php echo ($cart_count > 0) ? '' : 'display:none;'; ?>">
                    <?php echo $cart_count; ?>
                </span>
            </a>
        </nav>

        <div class="main">
            <div class="men_text">
                <h1>Taste the<span>cake you’ve been</span><br>dreaming of</h1>
            </div>
            <div class="main_image">
                <img src="photocakes/download.png" alt="Main Cake">
            </div>
        </div>
    </section>

    <div class="menu">
        <h1>Our <span>Menu</span></h1>
        <div class="menu_box">
            <?php if (count($cakes) > 0): ?>
                <?php foreach ($cakes as $cake): ?>
                    <div class="menu_card">
                        <div class="menu_image">
                            <img src="photocakes/<?php echo htmlspecialchars($cake['imazhi']); ?>" alt="Cake">
                        </div>
                        <div class="tooltip">
                            <p><?php echo htmlspecialchars($cake['pershkrimi']); ?></p>
                        </div>
                        <div class="menu_info">
                            <h2><?php echo htmlspecialchars($cake['emri']); ?></h2>
                            <h3>€<?php echo number_format($cake['cmimi'], 2); ?></h3>
                            
                            <form class="ajax-cart-form">
                                <input type="hidden" name="id" value="<?php echo $cake['id']; ?>">
                                <input type="hidden" name="emri" value="<?php echo htmlspecialchars($cake['emri']); ?>">
                                <input type="hidden" name="cmimi" value="<?php echo $cake['cmimi']; ?>">
                                <input type="hidden" name="add_to_cart" value="1">
                                <button type="submit" class="add-cart-btn">Shto në Shportë</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nuk u gjet asnjë tortë në menu.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="multi-carousel-section">
        <h1>We also offer birthday cakes.</h1> 
        <div class="carousel-wrapper">
            <a class="prev-multi" onclick="moveCarousel(-1)">&#10094;</a>
            <div class="carousel-viewport">
                <div class="carousel-track">
                    <?php if (count($bday_cakes) > 0): ?>
                        <?php foreach ($bday_cakes as $bday): ?>
                            <div class="carousel-card">
                                <div class="card-image">
                                    <img src="photocakes/<?php echo htmlspecialchars($bday['imazhi']); ?>" alt="Birthday Cake">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div> 
            <a class="next-multi" onclick="moveCarousel(1)">&#10095;</a>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-bottom">© 2026 SweetCakes. All Rights Reserved.</div>
    </footer>

    <script>
    document.querySelectorAll('.ajax-cart-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault(); 

            const formData = new FormData(this);

            fetch('cakes.php', {
                method: 'POST',
                body: formData,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.text())
            .then(count => {
                const badge = document.getElementById('cart-count');
                badge.innerText = count;
                badge.style.display = 'block'; 
                
               
                alert("U shtua në shportë!");
            })
            .catch(error => console.error('Gabim:', error));
        });
    });
    </script>
    <script src="cakes.js"></script>
</body>
</html>