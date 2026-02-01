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
    header("Location: porosite.php"); 
    exit();
}

$query = "SELECT * FROM offers";
$stmt = $pdo->prepare($query);
$stmt->execute();
$offers = $stmt->fetchAll(PDO::FETCH_ASSOC);


$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SweetCakes - Offers</title>
    <link rel="stylesheet" href="offers.css">
    <style>
        .shopping-cart-container {
            position: relative;
            display: inline-block;
        }
        .cart-count-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 2px 7px;
            font-size: 12px;
            font-weight: bold;
            border: 2px solid white;
        }
        .add-cart-btn {
            background-color: #ff69b4;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
            transition: 0.3s;
        }
        .add-cart-btn:hover { background-color: #ff1493; }
    </style>
</head>
<body>
    <section id="Cakes">
        <nav>
            <div class="logo">
                <img src="homepage/logoja.png" alt="Logo">
            </div>
            <ul>
                <li><a href="pastry.php">Home</a></li>
                <li><a href="cakes.php">Cakes</a></li>
                <li><a href="offers.php">Offers</a></li>
                <li><a href="build.php">Build your own</a></li>

                <?php if(isset($_SESSION['role']) && $_SESSION['role'] === "admin"): ?>
                    <li><a href="dashboard.php">Dashboard</a></li>
                <?php endif; ?>

                <?php if(isset($_SESSION['username'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="loginpage.php">Login</a></li>
                <?php endif; ?>
            </ul>

            <a href="porosite.php" class="shopping-cart-container">
                <img src="homepage/Screenshot 2025-12-15 193709.png" alt="Shporta" width="50">
                <?php if($cart_count > 0): ?>
                    <span class="cart-count-badge"><?php echo $cart_count; ?></span>
                <?php endif; ?>
            </a>
        </nav>

        <div class="menu-container">
            <header class="menu-header">
                <h1 class="main-title">
                    <span class="d-letter">O</span>UR
                    <span class="d-letter">O</span>FFERS
                </h1>
            </header>

            <main class="dessert-section">
                <?php if (count($offers) > 0): ?>
                    <?php foreach ($offers as $offer): ?>
                        <div class="menu-item item-2">
                            <div class="info-block align-left">
                                <p class="price">€<?php echo number_format($offer['cmimi'], 2); ?></p>
                                <h2 class="dessert-name"><?php echo htmlspecialchars($offer['emri']); ?></h2>
                                <p class="description"><?php echo htmlspecialchars($offer['pershkrimi']); ?></p>
                                
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?php echo $offer['id']; ?>">
                                    <input type="hidden" name="emri" value="<?php echo htmlspecialchars($offer['emri']); ?>">
                                    <input type="hidden" name="cmimi" value="<?php echo $offer['cmimi']; ?>">
                                    <button type="submit" name="add_to_cart" class="add-cart-btn">Shto në Shportë</button>
                                </form>
                            </div>
                            <img src="offerspage/<?php echo htmlspecialchars($offer['imazhi']); ?>" alt="Dessert" class="dessert-img">
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align:center; color: white;">Aktualisht nuk ka oferta në dispozicion.</p>
                <?php endif; ?>
            </main>
        </div>
           <footer class="footer">
        <div class="footer-content">
            <div class="footer-section about">
                <h3>SweetCakes</h3>
                <p>Cakes made with love and the finest ingredients.</p>
            </div>
            <div class="footer-section location">
                <h4>Location</h4>
                <p>Prishtina, Kosovo</p>
                <p>Rr. Bulevardi Bill Clinton</p>
            </div>
            <div class="footer-section contact">
                <h4>Contact Us</h4>
                <p>Email: info@sweetcakes.com</p>
                <p>Phone: +383 44 000 000</p>
            </div>
        </div>
        <div class="footer-bottom">
            © 2026 SweetCakes. All Rights Reserved.
        </div>
    </footer>
    </section>
</body>
</html>