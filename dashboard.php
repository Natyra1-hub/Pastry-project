<?php
session_start();
require_once 'database.php';

if(!isset($_SESSION['role']) || $_SESSION['role'] !== "admin"){
    header("Location: loginpage.php");
    exit;
}
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
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="pastry.php">Home</a></li>
            <li><a href="offers.php">Offers</a></li>
            <li><a href="cakes.php">Cakes</a></li>
            <li><a href="build.php">Build Your Own</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </aside>

    <main class="main">

        <header class="topbar">
            <h1>Dashboard</h1>
            <p>Welcome, Admin</p>
        </header>

        <section class="cards">
            <div class="card">
                <h3>Total Products</h3>
                <p>18</p>
            </div>
            <div class="card">
                <h3>Orders Today</h3>
                <p>7</p>
            </div>
            <div class="card">
                <h3>Monthly Revenue</h3>
                <p>€1,240</p>
            </div>
            <div class="card">
                <h3>Top Product</h3>
                <p>Red Velvet</p>
            </div>
        </section>

        <section class="simple-chart">
    <h2>Weekly Sales (€)</h2>
  <div class="bars">
    <div class="bar" style="height:40%" title="Mon: 120€"></div>
    <div class="bar" style="height:30%" title="Tue: 90€"></div>
    <div class="bar" style="height:50%" title="Wed: 150€"></div>
    <div class="bar" style="height:25%" title="Thu: 80€"></div>
    <div class="bar" style="height:67%" title="Fri: 200€"></div>
    <div class="bar" style="height:100%" title="Sat: 300€"></div> 
    <div class="bar" style="height:83%" title="Sun: 250€"></div>
</div>
    <div class="labels">
        <span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span><span>Sun</span>
    </div>
</section>


        <section class="table-box">
            <h2>Latest Orders</h2>
            <table>
                <tr>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                <tr>
                    <td>Ana</td>
                    <td>Cherry Kiss</td>
                    <td>1</td>
                    <td>31-01-2026</td>
                    <td><span class="status pending">Pending</span></td>
                </tr>
                <tr>
                    <td>John</td>
                    <td>Fruity Dream</td>
                    <td>6</td>
                    <td>31-01-2026</td>
                    <td><span class="status ready">Ready</span></td>
                </tr>
                <tr>
                    <td>Elona</td>
                    <td>Red Velvet</td>
                    <td>2</td>
                    <td>30-01-2026</td>
                    <td><span class="status delivered">Delivered</span></td>
                </tr>
            </table>
        </section>

    </main>
</div>

</body>
</html>