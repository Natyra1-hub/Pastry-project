<?php
session_start();
require_once 'database.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] !== "admin"){
    header("Location: loginpage.php");
    exit;
}

$db = new Database();
$pdo = $db->getConnection();


$totalProducts = $pdo->query("SELECT (SELECT COUNT(*) FROM products) + (SELECT COUNT(*) FROM cakes) + (SELECT COUNT(*) FROM offers)")->fetchColumn();
$ordersToday = $pdo->query("SELECT COUNT(*) FROM porosite WHERE DATE(data_krijimit) = CURDATE()")->fetchColumn();
$totalRevenue = $pdo->query("SELECT SUM(shuma_totale) FROM porosite")->fetchColumn() ?: 0;
$totalUsers = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();


if (isset($_GET['delete_id']) && isset($_GET['from'])) {
    $id = $_GET['delete_id'];
    $table = $_GET['from'];
    $allowed = ['products', 'cakes', 'offers', 'porosite', 'users', 'birthday_cakes'];
    
    if (in_array($table, $allowed)) {
        $pdo->prepare("DELETE FROM $table WHERE id = ?")->execute([$id]);
        header("Location: dashboard.php?view=$table");
        exit;
    }
}

$view = isset($_GET['view']) ? $_GET['view'] : 'porosite';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pastry Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dashboard.css">
</head>
<body>

<div class="dashboard">
    <aside class="sidebar">
        <h2>🍰 Pastry Admin</h2>
        <ul>

        <li><a href="pastry.php">🌐 View Website</a></li>
        
        <hr style="opacity: 0.2; margin: 10px 0;">

            <li><a href="dashboard.php" class="<?= !isset($_GET['view']) ? 'active' : '' ?>">📊 Dashboard</a></li>
         <li>
            <a href="dashboard.php?view=products" class="<?= (isset($_GET['view']) && $_GET['view'] == 'products') ? 'active' : '' ?>">🏠 Home Products</a>
        </li>

        <li>
            <a href="dashboard.php?view=cakes" class="<?= (isset($_GET['view']) && $_GET['view'] == 'cakes') ? 'active' : '' ?>">🎂 Cakes Menu</a>
        </li>

        <li>
            <a href="dashboard.php?view=offers" class="<?= (isset($_GET['view']) && $_GET['view'] == 'offers') ? 'active' : '' ?>">🏷️ Offers</a>
        </li>

        <li>
            <a href="dashboard.php?view=birthday_cakes" class="<?= (isset($_GET['view']) && $_GET['view'] == 'birthday_cakes') ? 'active' : '' ?>">🎈 Birthday Cakes</a>
        </li>

        <li>
            <a href="dashboard.php?view=porosite" class="<?= (isset($_GET['view']) && $_GET['view'] == 'porosite') ? 'active' : '' ?>">📦 Orders</a>
        </li>

        <li>
            <a href="dashboard.php?view=users" class="<?= (isset($_GET['view']) && $_GET['view'] == 'users') ? 'active' : '' ?>">👥 Users</a>
        </li>

        <hr style="opacity: 0.2; margin: 10px 0;">
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </aside>

    <main class="main">
        <header class="topbar">
            <h1>Admin Panel - <?= ucfirst($view) ?></h1>
            <div style="display:flex; align-items:center; gap:15px;">
        <a href="add_product.php" class="btn-add" style="background:#4caf50; color:white; padding:8px 15px; border-radius:5px; text-decoration:none;">+ Shto të Re</a>
            <p>Welcome, <?= $_SESSION['username'] ?? 'Admin' ?></p>
        </header>

        <section class="cards">
            <div class="card"><h3>Total Items</h3><p><?= $totalProducts ?></p></div>
            <div class="card"><h3>Orders Today</h3><p><?= $ordersToday ?></p></div>
            <div class="card"><h3>Revenue</h3><p>€<?= number_format($totalRevenue, 2) ?></p></div>
            <div class="card"><h3>Users</h3><p><?= $totalUsers ?></p></div>
        </section>

        <section class="table-box">
            <h2>Management: <?= ucfirst($view) ?></h2>
            <table>
                <thead>
                    <tr>
                        <?php if($view == 'users'): ?>
                            <th>Emri</th><th>Username</th><th>Role</th><th>Email</th>
                        <?php elseif($view == 'porosite'): ?>
                            <th>Klienti</th><th>Telefon</th><th>Shuma</th><th>Statusi</th>
                        <?php elseif($view == 'products'): ?>
                            <th>Titulli</th><th>Imazhi</th><th>Krijuar</th>
                        <?php else: ?>
                            <th>Emri</th><th>Çmimi</th><th>Imazhi</th>
                        <?php endif; ?>
                        <th>Veprimi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $pdo->query("SELECT * FROM $view ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
                    foreach($data as $row): ?>
                    <tr>
                        <?php if($view == 'users'): ?>
                            <td><?= $row['name'] ?></td><td><?= $row['username'] ?></td><td><?= $row['role'] ?></td><td><?= $row['email'] ?></td>
                        <?php elseif($view == 'porosite'): ?>
                            <td><?= $row['emri_klientit'] ?></td><td><?= $row['nr_telefonit'] ?></td><td>€<?= $row['shuma_totale'] ?></td><td><span class="status pending"><?= $row['statusi_porosise'] ?></span></td>
                        <?php elseif($view == 'products'): ?>
                            <td><?= $row['title'] ?></td><td><img src="<?= $row['image'] ?>" width="40"></td><td><?= $row['created_at'] ?></td>
                        <?php elseif($view == 'birthday_cakes'): ?>
                             <td>Cake #<?= $row['id'] ?></td><td>-</td><td><img src="homepage/<?= $row['imazhi'] ?>" width="40"></td>
                        <?php else: ?>
                            <td><?= $row['emri'] ?></td><td>€<?= $row['cmimi'] ?></td><td><img src="homepage/<?= $row['imazhi'] ?>" width="40"></td>
                        <?php endif; ?>
                        
                        <td>
                            <a href="dashboard.php?delete_id=<?= $row['id'] ?>&from=<?= $view ?>" onclick="return confirm('A jeni i sigurt?')">🗑️</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </main>
</div>
</body>
</html>