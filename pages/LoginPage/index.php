<?php
session_start();
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $users = require __DIR__ . '/../../staticData/dummies/users.staticData.php';
    $found = false;
    foreach ($users as $user) {
        if ($user['username'] === $username && $user['password'] === $password) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['first_name'] = $user['first_name'];
            header('Location: ../Homepage/index.php');
            exit;
        }
    }
    $error = 'Invalid username or password.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - AD TASK 3</title>
</head>
</head>
<body>
    <header>
        <h2>AD TASK 3</h2>
    </header>
    <main>
        <h1>Login</h1>
        <form method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
    </main>
    <footer>
        <p>Created by Christiane Banaag</p>
    </footer>
</body>
</html>
