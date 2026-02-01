<?php
session_start();
require_once 'database.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] !== "admin"){
    header("Location: loginpage.php");
    exit;
}

$db = new Database();
$pdo = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tabela = $_POST['tabela'];
    $emri = $_POST['emri'];
    $pershkrimi = $_POST['pershkrimi'];
    $cmimi = $_POST['cmimi'];
    $imazhi = $_FILES['imazhi']['name'];
    

    $target = "homepage/" . basename($imazhi);

    if (move_uploaded_file($_FILES['imazhi']['tmp_name'], $target)) {
        if ($tabela == "products") {

            $sql = "INSERT INTO products (title, description, ingredients, image, created_by) VALUES (?, ?, ?, ?, ?)";
            $pdo->prepare($sql)->execute([$emri, $pershkrimi, '', 'homepage/'.$imazhi, $_SESSION['user_id'] ?? 1]);
        } else {

            $sql = "INSERT INTO $tabela (emri, pershkrimi, cmimi, imazhi) VALUES (?, ?, ?, ?)";
            $pdo->prepare($sql)->execute([$emri, $pershkrimi, $cmimi, $imazhi]);
        }
        $msg = "Produkti u shtua me sukses!";
    } else {
        $msg = "Gabim gjatë ngarkimit të fotos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shto Produkt të Ri</title>
    <link rel="stylesheet" href="dashboard.css">
    <style>
        .form-container { background: white; padding: 30px; border-radius: 10px; max-width: 600px; margin: 50px auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input, select, textarea { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 5px; }
        .btn-submit { background: #df96c1; color: white; border: none; cursor: pointer; font-size: 16px; margin-top: 10px; }
        .btn-submit:hover { background: #c87fb0; }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Shto Produkt/Ofertë të Re</h2>
        <?php if(isset($msg)) echo "<p style='color:green'>$msg</p>"; ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Zgjidh Kategorinë (Tabelën):</label>
                <select name="tabela" required>
                    <option value="cakes">Cakes Menu</option>
                    <option value="offers">Special Offers</option>
                    <option value="products">Homepage Products</option>
                </select>
            </div>
            
            <div class="form-group">
                <label>Emri / Titulli:</label>
                <input type="text" name="emri" required>
            </div>

            <div class="form-group">
                <label>Përshkrimi:</label>
                <textarea name="pershkrimi" rows="4"></textarea>
            </div>

            <div class="form-group">
                <label>Çmimi (€):</label>
                <input type="number" step="0.01" name="cmimi">
            </div>

            <div class="form-group">
                <label>Imazhi:</label>
                <input type="file" name="imazhi" required>
            </div>

            <button type="submit" class="btn-submit">Ruaj Produktin</button>
            <a href="dashboard.php" style="display:block; text-align:center; margin-top:15px; text-decoration:none; color:#777;">Kthehu te Dashboard</a>
        </form>
    </div>
</body>
</html>