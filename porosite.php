<?php
session_start();
require_once 'Database.php';

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
        header("Location: loginpage.php");
        exit();
    }

    $db = new Database();
    $pdo = $db->getConnection();

    $emri = htmlspecialchars($_POST['emri_klientit']);
    $adresa = htmlspecialchars($_POST['adresa_klientit']);
    $tel = htmlspecialchars($_POST['nr_tel']);
    $user_id = $_SESSION['user_id'];
    $totali = $_POST['total_hidden'];

    try {
        $query = "INSERT INTO orders (user_id, emri_klientit, adresa, telefoni, totali, statusi) VALUES (?, ?, ?, ?, ?, 'Pending')";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$user_id, $emri, $adresa, $tel, $totali]);
        
        unset($_SESSION['cart']);
        $porosiaKryer = true;
    } catch (PDOException $e) {
        die("Gabim: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SweetCakes - Checkout</title>
    <link rel="stylesheet" href="offers.css">
    <style>
        
        .checkout-container { max-width: 900px; margin: 50px auto; background: #F8E3EF; padding: 40px; border-radius: 15px; border: 1px solid #ff69b4; color: #6c0c31; font-family: sans-serif; }
        .info-box { background: rgba(227, 153, 186, 0.81); padding: 20px; border-radius: 10px; margin-bottom: 20px; color: white; }
        .cart-table { width: 100%; border-collapse: collapse; }
        .cart-table td { padding: 12px; border-bottom: 1px solid rgba(255,255,255,0.2); }
        .remove-link { color: #000000; text-decoration: none; font-size: 0.9rem; font-weight: bold; }
        .remove-link:hover { text-decoration: underline; }
        .form-input { width: 100%; padding: 12px; margin: 10px 0; border-radius: 5px; border: 1px solid #ff69b4; background: white; color: #333; box-sizing: border-box; }
        .btn-confirm { background: #ff69b4; color: white; padding: 15px; border: none; border-radius: 50px; cursor: pointer; width: 100%; font-weight: bold; margin-top: 20px; font-size: 1rem; }
        .btn-confirm:hover { background: #ff1493; }
        .btn-back { display: inline-block; background: white; color: #ff69b4; padding: 10px 20px; border: 1px solid #ff69b4; border-radius: 50px; text-decoration: none; font-weight: bold; margin-bottom: 20px; }
        .btn-back:hover { background: #ff69b4; color: white; }
        h1 { color: #6c0c31; }
    </style>
</head>
<body>
    <div class="checkout-container">
        <a href="cakes.php" class="btn-back">← Shto diçka tjetër</a>

        <?php if ($porosiaKryer): ?>
            <div style="text-align:center; background:#28a745; padding:20px; border-radius:10px; color: white;">
                <h2>🎉 Porosia u dërgua me sukses!</h2>
                <p>Mund ta shihni në Dashboard-in tuaj.</p>
                <a href="cakes.php" style="color:white; font-weight: bold;">Kthehu te Menuja</a>
            </div>

        <?php elseif (!empty($_SESSION['cart'])): ?>
            <h1>Përfundo Porosinë</h1>
            <div class="info-box">
                <table class="cart-table">
                    <?php $total = 0; foreach ($_SESSION['cart'] as $index => $item): $total += $item['cmimi']; ?>
                    <tr>
                        <td><strong><?php echo $item['emri']; ?></strong></td>
                        <td style="text-align:right;">$<?php echo number_format($item['cmimi'], 2); ?></td>
                        <td style="text-align:right;">
                            <a href="porosite.php?remove=<?php echo $index; ?>" class="remove-link">❌ Heq</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <tr style="color: #6c0c31; font-size: 1.5rem;">
                        <td><strong>TOTALI</strong></td>
                        <td style="text-align:right;"><strong>$<?php echo number_format($total, 2); ?></strong></td>
                        <td></td>
                    </tr>
                </table>
            </div>

            <?php if (!$isLoggedIn): ?>
                <div style="text-align:center; border: 2px dashed #ff69b4; padding:20px; color: #6c0c31; border-radius: 10px;">
                    <p style="font-weight: bold;">⚠️ Duhet të kyçeni për të dërguar porosinë.</p>
                    <a href="loginpage.php" class="btn-confirm" style="display:block; text-decoration:none;">KYÇU KËTU</a>
                </div>
            <?php else: ?>
                <form method="POST">
                    <h3 style="margin-bottom: 0;">Detajet e dërgimit:</h3>
                    <input type="hidden" name="total_hidden" value="<?php echo $total; ?>">
                    <input type="text" name="emri_klientit" class="form-input" required placeholder="Emri dhe Mbiemri juaj">
                    <input type="text" name="adresa_klientit" class="form-input" required placeholder="Rruga, Qyteti, Kodi Postar">
                    <input type="tel" name="nr_tel" class="form-input" required placeholder="Numri i telefonit (Psh: 04x xxx xxx)">
                    <button type="submit" name="konfirmo_porosine" class="btn-confirm">DËRGO POROSINË TANI</button>
                </form>
            <?php endif; ?>

        <?php else: ?>
            <div style="text-align:center;">
                <p style="font-size: 1.2rem;">Shporta është bosh.</p>
                <a href="cakes.php" class="btn-confirm" style="display:inline-block; width: auto; text-decoration: none;">SHKO TE MENUJA</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>