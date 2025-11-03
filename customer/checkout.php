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
    <title>Checkout - Bisfa Farm</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .checkout {
            padding: 4rem 0;
            background-color: #f5f5f5;
        }
        .checkout-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 20px;
        }
        .checkout h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 2rem;
        }
        .cart-items {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
        }
        .cart-item:last-child {
            border-bottom: none;
        }
        .checkout-form {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .checkout-form h2 {
            color: #4CAF50;
            margin-bottom: 1rem;
        }
        .checkout-form input, .checkout-form textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        .checkout-form textarea {
            height: 100px;
            resize: vertical;
        }
        .total {
            font-size: 1.5rem;
            font-weight: bold;
            color: #4CAF50;
            text-align: center;
            margin: 1rem 0;
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
                <li><a href="dashboard.php">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <section class="checkout">
        <div class="checkout-container">
            <h1>Checkout</h1>
            <div class="cart-items" id="cart-items">
                <!-- Cart items will be loaded here -->
            </div>
            <div class="checkout-form">
                <h2>Detail Pengiriman</h2>
                <form action="process_checkout.php" method="POST">
                    <input type="text" name="name" placeholder="Nama Lengkap" value="<?php echo $_SESSION['customer_name']; ?>" required>
                    <input type="email" name="email" placeholder="Email" value="<?php echo $_SESSION['customer_email']; ?>" required>
                    <input type="text" name="phone" placeholder="Nomor Telepon" required>
                    <textarea name="address" placeholder="Alamat Lengkap" required></textarea>
                    <div class="total" id="total-price">Total: Rp 0</div>
                    <button type="submit" class="btn">Pesan Sekarang</button>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Bisfa Farm. All Rights Reserved.</p>
    </footer>

    <script src="../assets/js/script.js"></script>
    <script>
        // Load cart from localStorage
        function loadCart() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            const cartItemsDiv = document.getElementById('cart-items');
            const totalDiv = document.getElementById('total-price');
            let total = 0;

            if (cart.length === 0) {
                cartItemsDiv.innerHTML = '<p>Keranjang kosong.</p>';
                return;
            }

            cartItemsDiv.innerHTML = '<h3>Keranjang Belanja</h3>';
            cart.forEach(item => {
                const itemDiv = document.createElement('div');
                itemDiv.className = 'cart-item';
                itemDiv.innerHTML = `
                    <span>${item.name} (x${item.quantity})</span>
                    <span>Rp ${(item.price * item.quantity).toLocaleString()}</span>
                `;
                cartItemsDiv.appendChild(itemDiv);
                total += item.price * item.quantity;
            });

            totalDiv.textContent = `Total: Rp ${total.toLocaleString()}`;
        }

        loadCart();
    </script>
</body>
</html>
