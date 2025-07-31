<?php
// 404 Page Not Found Error
$pageTitle = "404 - Page Not Found | AD TASK 3";
include LAYOUTS_PATH . '/header.layout.php';
?>

<main style="text-align: center; margin-top: 50px;">
    <h1>404 - Page Not Found</h1>
    <p>Sorry, the page you are looking for does not exist.</p>
    <p>Please check the URL or go back to the homepage.</p>
    <a href="/index.php">
        <button type="button">Go to Homepage</button>
    </a>
</main>

<?php include LAYOUTS_PATH . '/footer.layout.php'; ?>
