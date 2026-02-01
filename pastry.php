<?php
session_start();

$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>

    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
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
            padding: 8px 12px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
            font-size: 14px;
            transition: 0.3s;
            width: 100%;
        }
        .add-cart-btn:hover { background-color: #ff1493; }
        .menu_info h3 { margin-bottom: 5px; }
    </style>
    <title>Document</title>
</head>
<body>

     <section id="Cakes">
        <nav>
            <div class="logo">
                <img src="homepage/logoja.png" alt="">
            </div>
            <ul>
           <li><a href="pastry.php">Home</a></li>
                <li><a href="cakes.php">Cakes</a></li>
                <li><a href="offers.php">Offers</a></li>
                <li><a href="build.php">Build your own</a></li>


            <?php
            if(isset($_SESSION['role']) && $_SESSION['role'] === "admin") {
            echo '<li><a href="dashboard.php">Dashboard</a></li>';
            }
        ?>

          <?php
            if(isset($_SESSION['username'])){
            echo '<li><a href="logout.php">Logout</a></li>';
            } else {
            echo '<li><a href="loginpage.php">Login</a></li>';
            }
        ?>

        </ul>

            <a href="porosite.php" class="shopping-cart-container">
        <img src="homepage/Screenshot 2025-12-15 193709.png" alt="Shporta" width="50">
        <?php if($cart_count > 0): ?>
            <span class="cart-count-badge"><?php echo $cart_count; ?></span>
        <?php endif; ?>
    </a>

        </nav>

    <div class="banner">
    <video autoplay muted loop class="banner-video">
        <source src="homepage/Pink and White Simple We Are Open Video.mp4" type="video/mp4">
    </video>
    </div>
 
    <div class="gallery">
        <div class="cake">
            <a href="CherryChocolate.php">
            <img src="homepage/photo9.jpg" alt="Cake 1">
            <p class="cake-name">Cherry Chocolate Delight</p>
            </a>
        </div>

        <div class="cake">
            <a href="RedVelvet.php">
            <img src="homepage/photo2.jpg" alt="Cake 2">
            <p class="cake-name">Red Velvet</p>
            </a>
        </div>

        <div class="cake">
            <a href="StrawberrySurprise.php">
            <img src="homepage/photo3.jpg" alt="Cake 3">
            <p class="cake-name">Strawberry Surprise</p>
            </a>
        </div>

        <div class="cake">
            <a href="RaspberryRose.php">
            <img src="homepage/photo8.jpg" alt="Cake 4">
            <p class="cake-name">Raspberry Rose</p>
            </a>
        </div>

         <div class="cake">
            <a href="CherryKiss.php">
            <img src="homepage/photo4.jpg" alt="Cake 5">
            <p class="cake-name">Cherry Kiss</p>
            </a>
        </div>

        <div class="cake">
            <a href="FruityDream.php">
            <img src="homepage/photo10.jpg" alt="Cake 6">
            <p class="cake-name">Fruity Dream</p>
            </a>
        </div>

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
        © 2025 SweetCakes. All Rights Reserved.
    </div>
</footer>

</body>
</html>