<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['register_error'] = 'Semua field harus diisi.';
        header('Location: register.php');
        exit;
    }

    if ($password !== $confirm_password) {
        $_SESSION['register_error'] = 'Password dan konfirmasi password tidak cocok.';
        header('Location: register.php');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['register_error'] = 'Format email tidak valid.';
        header('Location: register.php');
        exit;
    }

    // Load existing customers
    $customers_file = '../data/customers.json';
    $customers = json_decode(file_get_contents($customers_file), true) ?? [];

    // Check if email already exists
    foreach ($customers as $customer) {
        if ($customer['email'] === $email) {
            $_SESSION['register_error'] = 'Email sudah terdaftar.';
            header('Location: register.php');
            exit;
        }
    }

    // Add new customer
    $new_customer = [
        'id' => count($customers) + 1,
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'created_at' => date('Y-m-d H:i:s')
    ];
    $customers[] = $new_customer;

    // Save to file
    file_put_contents($customers_file, json_encode($customers, JSON_PRETTY_PRINT));

    $_SESSION['register_success'] = 'Akun berhasil dibuat. Silakan masuk.';
    header('Location: login.php');
    exit;
} else {
    header('Location: register.php');
    exit;
}
?>
