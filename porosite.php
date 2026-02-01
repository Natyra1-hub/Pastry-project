<?php
session_start();
require_once 'Database.php';

$db = new Database();
$pdo = $db->getConnection();

$isLoggedIn = isset($_SESSION['user_id']); 
$porosiaKryer = false;

// 1. Largimi i produktit nga shporta
if (isset($_GET['remove'])) {
    $id_per_heqje = $_GET['remove'];
    if (isset($_SESSION['cart'][$id_per_heqje])) {
        unset($_SESSION['cart'][$id_per_heqje]);
    }
    header("Location: porosite.php");
    exit();
}

// 2. Procesimi i porosisë
if (isset($_POST['konfirmo_porosine'])) {
    if (!$isLoggedIn) {
        header("Location: loginpage.php?redirect=porosite.php");
        exit();
    }

    $emri = htmlspecialchars($_POST['emri_klientit']);
    $adresa = htmlspecialchars($_POST['adresa_klientit']);
    $tel = htmlspecialchars($_POST['nr_tel']);
    $totali = $_POST['total_hidden'];
    $user_id = $_SESSION['user_id'];

    try {
        // Ruajmë porosinë në tabelën 'porosite' (përshtatur me dashboard-in tënd)
        $query = "INSERT INTO porosite (emri_klientit, nr_telefonit, shuma_totale, statusi_porosise, data_krijimit) 
                  VALUES (?, ?, ?, 'Pending', NOW())";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$emri, $tel, $totali]);
        
        // Opsionale: Ruajmë edhe adresën nëse e ke shtuar kolonën në DB
        // $pdo->prepare("UPDATE porosite SET adresa = ? WHERE id = LAST_INSERT_ID()")->execute([$adresa]);

        unset($_SESSION['cart']); // Zbrazim shportën
        $porosiaKryer = true;
    } catch (PDOException $e) {
        die("Gabim gjatë procesimit: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <title>SweetCakes - Checkout</title>
    <link rel="stylesheet" href="offers.css">
    <style>
        body { background-color: #fff5f8; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .checkout-container { max-width: 800px; margin: 50px auto; background: #F8E3EF; padding: 40px; border-radius: 15px; border: 1px solid #ff69b4; color: #6c0c31; }
        .info-box { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; border-left: 5px solid #ff69b4; }
        .cart-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .cart-table td { padding: 15px; border-bottom: 1px solid #eee; }
        .form-group { margin-bottom: 15px; }
        .form-input { width: 100%; padding: 12px; margin-top: 5px; border-radius: 8px; border: 1px solid #ccc; box-sizing: border-box; }
        .btn-confirm { background: #ff69b4; color: white; padding: 15px; border: none; border-radius: 50px; cursor: pointer; width: 100%; font-weight: bold; font-size: 1.1rem; transition: 0.3s; text-transform: uppercase; }
        .btn-confirm:hover { background: #ff1493; transform: scale(1.02); }
        .btn-back { display: inline-block; color: #ff69b4; text-decoration: none; font-weight: bold; margin-bottom: 20px; }
        .status-msg { text-align: center; padding: 30px; background: white; border-radius: 15px; border: 2px solid #28a745; }
        label { font-weight: bold; font-size: 0.9rem; }
    </style>
</head>
<body>

<div class="checkout-container">
    <a href="cakes.php" class="btn-back">← Kthehu te produktet</a>

    <?php if ($porosiaKryer): ?>
        <div class="status-msg">
            <h2 style="color: #28a745;">🎉 Porosia u dërgua!</h2>
            <p>Faleminderit <strong><?= htmlspecialchars($emri) ?></strong>. Porosia juaj po bëhet gati.</p>
            <a href="pastry.php" class="btn-confirm" style="display:inline-block; margin-top:20px; text-decoration:none;">Kthehu në Fillim</a>
        </div>

    <?php elseif (!empty($_SESSION['cart'])): ?>
        <h1>Përmbledhja e Shportës</h1>
        
        <div class="info-box">
            <table class="cart-table">
                <?php $total = 0; foreach ($_SESSION['cart'] as $index => $item): $total += $item['cmimi']; ?>
                <tr>
                    <td><strong><?= $item['emri'] ?></strong></td>
                    <td style="text-align:right;">€<?= number_format($item['cmimi'], 2) ?></td>
                    <td style="text-align:right;">
                        <a href="porosite.php?remove=<?= $index ?>" style="text-decoration:none;">❌</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr style="font-size: 1.3rem; color: #ff1493;">
                    <td><strong>TOTALI</strong></td>
                    <td style="text-align:right;"><strong>€<?= number_format($total, 2) ?></strong></td>
                    <td></td>
                </tr>
            </table>
        </div>

        <?php if (!$isLoggedIn): ?>
            <div style="text-align:center; background: white; padding: 30px; border-radius: 10px; border: 2px dashed #ff69b4;">
                <h3 style="margin-bottom: 10px;">Pothuajse gati!</h3>
                <p>Duhet të kyçeni që të na jepni adresën tuaj të dërgimit.</p>
                <br>
                <a href="loginpage.php?redirect=porosite.php" class="btn-confirm" style="display:block; text-decoration:none;">KYÇU PËR TË VAZHDUAR</a>
            </div>
        <?php else: ?>
            <form method="POST" action="porosite.php">
                <h3 style="border-bottom: 2px solid #ff69b4; padding-bottom: 10px;">Detajet e dërgimit</h3>
                <input type="hidden" name="total_hidden" value="<?= $total ?>">
                
                <div class="form-group">
                    <label>Emri dhe Mbiemri</label>
                    <input type="text" name="emri_klientit" class="form-input" required placeholder="Filan Fisteku">
                </div>

                <div class="form-group">
                    <label>Adresa e Shtëpisë</label>
                    <input type="text" name="adresa_klientit" class="form-input" required placeholder="Rruga, Qyteti, Nr. i shtëpisë">
                </div>

                <div class="form-group">
                    <label>Numri i Telefonit</label>
                    <input type="tel" name="nr_tel" class="form-input" required placeholder="044 123 456">
                </div>

                <button type="submit" name="konfirmo_porosine" class="btn-confirm">DËRGO POROSINË TANI</button>
            </form>
        <?php endif; ?>

    <?php else: ?>
        <div style="text-align:center;">
            <p>Shporta juaj është bosh.</p>
            <a href="cakes.php" class="btn-confirm" style="display:inline-block; width:auto; text-decoration:none; padding: 10px 30px;">Shko te Menuja</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>