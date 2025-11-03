<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bisfa Farm</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .dashboard {
            padding: 4rem 0;
            background-color: #f5f5f5;
        }
        .dashboard-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .dashboard h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 2rem;
        }
        .welcome {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
            text-align: center;
        }
        .orders {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .orders h2 {
            color: #4CAF50;
            margin-bottom: 1rem;
        }
        .order-item {
            border-bottom: 1px solid #eee;
            padding: 1rem 0;
        }
        .order-item:last-child {
            border-bottom: none;
        }
        .order-status {
            font-weight: bold;
        }
        .status-pending { color: orange; }
        .status-processing { color: blue; }
        .status-completed { color: green; }
        .status-cancelled { color: red; }
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
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="dashboard">
        <div class="dashboard-container">
            <h1>Dashboard Pelanggan</h1>
            <div class="welcome">
                <h2>Selamat datang, <?php echo $_SESSION['customer_name']; ?>!</h2>
                <p>Kelola pesanan dan akun Anda di sini.</p>
            </div>
            <div class="orders">
                <h2>Riwayat Pesanan</h2>
                <?php
                $orders_file = '../data/orders.json';
                $orders = json_decode(file_get_contents($orders_file), true) ?? [];
                $customer_orders = array_filter($orders, function($order) {
                    return $order['customer_id'] == $_SESSION['customer_id'];
                });

                if (empty($customer_orders)) {
                    echo '<p>Anda belum memiliki pesanan.</p>';
                } else {
                    foreach ($customer_orders as $order) {
                        $status_class = 'status-' . $order['status'];
                        echo '<div class="order-item">';
                        echo '<p><strong>Pesanan #' . $order['id'] . '</strong> - ' . date('d/m/Y H:i', strtotime($order['created_at'])) . '</p>';
                        echo '<p>Total: Rp ' . number_format($order['total']) . '</p>';
                        echo '<p class="order-status ' . $status_class . '">' . ucfirst($order['status']) . '</p>';
                        echo '</div>';
                    }
                }
                ?>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Bisfa Farm. All Rights Reserved.</p>
    </footer>

    <script src="../assets/js/script.js"></script>
</body>
</html>
