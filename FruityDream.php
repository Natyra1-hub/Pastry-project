<?php
require_once "database.php"; 

$db = new Database();
$conn = $db->getConnection();

$stmt = $conn->prepare("SELECT * FROM products WHERE title = :title LIMIT 1");
$stmt->execute(['title' => 'Fruity Dream']);
$cake = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cake) {
    die("Cake not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="FruityDream.css">
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
            </ul>

            <a href="loginpage.php" class="shopping-cart">
            <img src="homepage/Screenshot 2025-12-15 193709.png" alt="Shporta" width="50">
        </a>
    </nav>

        <div class="cake-container">
            <img src="<?= $cake['image'] ?>" alt="<?= htmlspecialchars($cake['title']) ?> Cake">

            <div class="cake-text">
                <h1>🍒🫐 <?= htmlspecialchars($cake['title']) ?> Cake Ingredients</h1>

                <p><?= nl2br(htmlspecialchars($cake['description'])) ?></p>

                <?= $cake['ingredients'] ?>
            </div>
        </div>
</section>

</body>
</html>