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
$pageTitle = "Homepage - AD TASK 3";

include LAYOUTS_PATH . '/header.layout.php';
?>
    <main>
        <div class="welcome-container">
            <h1>Welcome user <?= htmlspecialchars($username) ?></h1>
            <form method="get">
                <button type="submit" name="logout" value="1" class="logout-btn">Logout</button>
            </form>
        </div>
    </main>
<?php include LAYOUTS_PATH . '/footer.layout.php';
