<?php
// Login page using components and layouts
require_once COMPONENTS_PATH . '/login.component.php';

$pageTitle = "Login - AD TASK 3";
$error = handleLogin();

include LAYOUTS_PATH . '/header.layout.php';
renderLoginForm($error);
include LAYOUTS_PATH . '/footer.layout.php';
