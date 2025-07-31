
<?php
$pageTitle = "AD TASK 3 - Homepage";
include LAYOUTS_PATH . '/header.layout.php';
?>
    <main>
        <div class="homepage-container">
            <div class="welcome-card">
                <h1>Welcome to my AD TASK 3</h1>
                <form action="/pages/LoginPage/index.php" method="get">
                    <button type="submit" class="login-btn">Go to Login</button>
                </form>
            </div>
        </div>
    </main>
<?php include LAYOUTS_PATH . '/footer.layout.php';
?>