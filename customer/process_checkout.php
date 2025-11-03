<?php
session_start();
if (!isset($_SESSION['customer_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // Get cart from POST data (assuming it's sent as JSON)
    $cart = json_decode($_POST['cart'], true) ?? [];

    if (empty($cart)) {
        $_SESSION['checkout_error'] = 'Keranjang kosong.';
        header('Location: checkout.php');
        exit;
    }

    // Calculate total
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }

    // Create order
    $orders_file = '../data/orders.json';
    $orders = json_decode(file_get_contents($orders_file), true) ?? [];

    $new_order = [
        'id' => count($orders) + 1,
        'customer_id' => $_SESSION['customer_id'],
        'customer_name' => $name,
        'customer_email' => $email,
        'customer_phone' => $phone,
        'customer_address' => $address,
        'items' => $cart,
        'total' => $total,
        'status' => 'pending',
        'created_at' => date('Y-m-d H:i:s')
    ];
    $orders[] = $new_order;

    // Save to file
    file_put_contents($orders_file, json_encode($orders, JSON_PRETTY_PRINT));

    // Clear cart (in session or localStorage, but since it's client-side, we'll handle in JS)
    // For simplicity, we'll assume cart is cleared on success

    $_SESSION['checkout_success'] = 'Pesanan berhasil dibuat. Kami akan menghubungi Anda segera.';
    header('Location: dashboard.php');
    exit;
} else {
    header('Location: checkout.php');
    exit;
}
?>
