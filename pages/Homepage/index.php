<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../LoginPage/index.php');
    exit;
}
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../../index.php');
    exit;
}
$username = $_SESSION['first_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage - AD TASK 3</title>
</head>
</head>
<body>
    <header>
        <h2>AD TASK 3</h2>
    </header>
    <main>
        <h1>Welcome user <?= htmlspecialchars($username) ?></h1>
        <form method="get">
            <button type="submit" name="logout" value="1">Logout</button>
        </form>
    </main>
    <footer>
        <p>Created by Christiane Banaag</p>
    </footer>
</body>
</html>
