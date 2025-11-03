<?php
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Bisfa Farm</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .dashboard {
            padding: 4rem 0;
            background-color: #f5f5f5;
        }
        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .dashboard h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 2rem;
        }
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        .dashboard-card {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
        }
        .dashboard-card h3 {
            color: #4CAF50;
            margin-bottom: 1rem;
        }
        .dashboard-card a {
            display: inline-block;
            padding: 10px 20px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .dashboard-card a:hover {
            background: #45a049;
        }
        .logout-btn {
            text-align: center;
            margin-top: 2rem;
        }
        .logout-btn a {
            padding: 10px 20px;
            background: #f44336;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-btn a:hover {
            background: #d32f2f;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <header>
        <nav>
            <div class="logo">
                <img src="https://via.placeholder.com/100x50?text=Bisfa+Farm" alt="Bisfa Farm">
            </div>
            <ul>
                <li><a href="../index.html">Beranda</a></li>
                <li><a href="../products.html">Produk</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="dashboard">
        <div class="dashboard-container">
            <h1>Admin Dashboard</h1>
            <div class="dashboard-grid">
                <div class="dashboard-card">
                    <h3>Kelola Produk</h3>
                    <p>Tambah, edit, atau hapus produk.</p>
                    <a href="manage_products.php">Kelola Produk</a>
                </div>
                <div class="dashboard-card">
                    <h3>Lihat Pesanan</h3>
                    <p>Lihat dan kelola pesanan pelanggan.</p>
                    <a href="view_orders.php">Lihat Pesanan</a>
                </div>
                <div class="dashboard-card">
                    <h3>Kelola Pelanggan</h3>
                    <p>Lihat dan kelola data pelanggan.</p>
                    <a href="manage_customers.php">Kelola Pelanggan</a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Bisfa Farm. All Rights Reserved.</p>
    </footer>
</body>
</html>
