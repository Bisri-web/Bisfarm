<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validation
    if (empty($email) || empty($password)) {
        $_SESSION['login_error'] = 'Email dan password harus diisi.';
        header('Location: login.php');
        exit;
    }

    // Load customers
    $customers_file = '../data/customers.json';
    $customers = json_decode(file_get_contents($customers_file), true) ?? [];

    // Check credentials
    foreach ($customers as $customer) {
        if ($customer['email'] === $email && password_verify($password, $customer['password'])) {
            $_SESSION['customer_id'] = $customer['id'];
            $_SESSION['customer_name'] = $customer['name'];
            $_SESSION['customer_email'] = $customer['email'];
            header('Location: dashboard.php');
            exit;
        }
    }

    $_SESSION['login_error'] = 'Email atau password salah.';
    header('Location: login.php');
    exit;
} else {
    header('Location: login.php');
    exit;
}
?>
