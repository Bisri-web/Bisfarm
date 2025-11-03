<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Bisfa Farm</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .register-container {
            max-width: 400px;
            margin: 5rem auto;
            padding: 2rem;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(77, 8, 226, 0.1);
        }
        .register-container h2 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 2rem;
        }
        .register-form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }
        .register-form button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .register-form button:hover {
            background-color: #45a049;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 1rem;
        }
        .success-message {
            color: green;
            text-align: center;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Daftar Akun</h2>
        <?php
        session_start();
        if (isset($_SESSION['register_error'])) {
            echo '<div class="error-message">' . $_SESSION['register_error'] . '</div>';
            unset($_SESSION['register_error']);
        }
        if (isset($_SESSION['register_success'])) {
            echo '<div class="success-message">' . $_SESSION['register_success'] . '</div>';
            unset($_SESSION['register_success']);
        }
        ?>
        <form class="register-form" action="process_register.php" method="POST">
            <input type="text" name="name" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Konfirmasi Password" required>
            <button type="submit">Daftar</button>
        </form>
        <p style="text-align: center; margin-top: 1rem;">Sudah punya akun? <a href="login.php">Masuk</a></p>
    </div>
</body>
</html>
