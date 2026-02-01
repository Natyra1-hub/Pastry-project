<?php
session_start();
require_once 'database.php'; 
$db = new Database();
$pdo = $db->getConnection();

$isLoggedIn = isset($_SESSION['user_id']); 
$porosiaKryer = false;


if (isset($_GET['remove'])) {
    $id_per_heqje = $_GET['remove'];
    if (isset($_SESSION['cart'][$id_per_heqje])) {
        unset($_SESSION['cart'][$id_per_heqje]);
    }
    header("Location: porosite.php");
    exit();
}


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
        
        $query = "INSERT INTO porosite (user_id, emri_klientit, adresa_dergimit, nr_telefonit, metoda_pageses, shuma_totale, statusi_porosise) 
                  VALUES (?, ?, ?, ?, 'Cash', ?, 'Ne pritje')";
        
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id, $emri, $adresa, $tel, $totali]);

      
        
        unset($_SESSION['cart']);
        $porosiaKryer = true;
    } catch (PDOException $e) {
        die("Gabim gjatë procesimit të porosisë: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - SweetCakes</title>
    <link rel="stylesheet" href="offers.css">
    <style>
        body { background-color: #fff5f8; font-family: 'Segoe UI', sans-serif; margin: 0; padding: 20px; }
        .checkout-container { max-width: 800px; margin: 30px auto; background: #F8E3EF; padding: 40px; border-radius: 15px; border: 1px solid #ff69b4; color: #6c0c31; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
        .info-box { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; border-left: 5px solid #ff69b4; }
        .cart-table { width: 100%; border-collapse: collapse; }
        .cart-table td { padding: 12px; border-bottom: 1px solid #f0f0f0; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; font-size: 0.9rem; }
        .form-input { width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #ddd; box-sizing: border-box; outline: none; transition: 0.3s; }
        .form-input:focus { border-color: #ff69b4; box-shadow: 0 0 5px rgba(255,105,180,0.3); }
        .btn-confirm { background: #ff69b4; color: white; padding: 15px; border: none; border-radius: 50px; cursor: pointer; width: 100%; font-weight: bold; font-size: 1.1rem; transition: 0.3s; text-transform: uppercase; margin-top: 10px; }
        .btn-confirm:hover { background: #ff1493; transform: translateY(-2px); }
        .btn-back { display: inline-block; color: #ff69b4; text-decoration: none; font-weight: bold; margin-bottom: 20px; }
        .status-msg { text-align: center; padding: 30px; background: white; border-radius: 15px; border: 2px solid #28a745; }
        .total-row { font-size: 1.3rem; color: #ff1493; font-weight: bold; }
        .empty-cart { text-align: center; padding: 40px; }
    </style>
</head>
<body>

<div class="checkout-container">
    <a href="cakes.php" class="btn-back">← Kthehu te produktet</a>

    <?php if ($porosiaKryer): ?>
        <div class="status-msg">
            <h2 style="color: #28a745;">🎉 Porosia u dërgua me sukses!</h2>
            <p>Faleminderit <strong><?= htmlspecialchars($emri) ?></strong>. Porosia juaj u regjistrua dhe po përpunohet.</p>
            <p>Statusi aktual: <span style="color: #ff69b4;">Ne pritje</span></p>
            <a href="pastry.php" class="btn-confirm" style="display:inline-block; margin-top:20px; text-decoration:none; width: auto; padding: 12px 40px;">Kthehu në Fillim</a>
        </div>

    <?php elseif (!empty($_SESSION['cart'])): ?>
        <h1>Përmbledhja e Porosisë</h1>
        
        <div class="info-box">
            <table class="cart-table">
                <?php 
                $total = 0; 
                foreach ($_SESSION['cart'] as $index => $item): 
                    $total += $item['cmimi']; 
                ?>
                <tr>
                    <td><strong><?= htmlspecialchars($item['emri']) ?></strong></td>
                    <td style="text-align:right;">€<?= number_format($item['cmimi'], 2) ?></td>
                    <td style="text-align:right;">
                        <a href="porosite.php?remove=<?= $index ?>" title="Hiqe nga shporta" style="text-decoration:none;">❌</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td>TOTALI PËR PAGESË</td>
                    <td style="text-align:right;">€<?= number_format($total, 2) ?></td>
                    <td></td>
                </tr>
            </table>
        </div>

        <?php if (!$isLoggedIn): ?>
            <div style="text-align:center; background: white; padding: 30px; border-radius: 10px; border: 2px dashed #ff69b4;">
                <h3 style="margin-bottom: 10px;">Edhe një hap!</h3>
                <p>Duhet të jeni të kyçur që të mund të dërgoni porosinë.</p>
                <br>
                <a href="loginpage.php?redirect=porosite.php" class="btn-confirm" style="display:block; text-decoration:none;">KYÇU PËR TË VAZHDUAR</a>
            </div>
        <?php else: ?>
            <form method="POST" action="porosite.php">
                <h3 style="border-bottom: 2px solid #ff69b4; padding-bottom: 10px; margin-top: 30px;">Detajet e dërgimit</h3>
                <input type="hidden" name="total_hidden" value="<?= $total ?>">
                
                <div class="form-group">
                    <label>Emri dhe Mbiemri i marrësit</label>
                    <input type="text" name="emri_klientit" class="form-input" required placeholder="p.sh. Filan Fisteku">
                </div>

                <div class="form-group">
                    <label>Adresa e plotë (Rruga, Qyteti, Nr. Hyrjes)</label>
                    <input type="text" name="adresa_klientit" class="form-input" required placeholder="p.sh. Rruga Agim Ramadani, Prishtinë">
                </div>

                <div class="form-group">
                    <label>Numri i Telefonit</label>
                    <input type="tel" name="nr_tel" class="form-input" required placeholder="p.sh. 044 123 456">
                </div>

                <p style="font-size: 0.8rem; color: #888; margin: 15px 0;">* Pagesa bëhet me para në dorë (Cash) në momentin e pranimit të porosisë.</p>

                <button type="submit" name="konfirmo_porosine" class="btn-confirm">KONFIRMO DHE DËRGO POROSINË</button>
            </form>
        <?php endif; ?>

    <?php else: ?>
        <div class="empty-cart">
            <div style="font-size: 4rem;">🛒</div>
            <h2>Shporta juaj është bosh!</h2>
            <p>Ju nuk keni shtuar asnjë ëmbëlsirë ende.</p>
            <br>
            <a href="cakes.php" class="btn-confirm" style="display:inline-block; width:auto; text-decoration:none; padding: 12px 40px;">SHIKO MENUNË</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>