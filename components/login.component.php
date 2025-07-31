<?php
// Login component - handles login logic and form rendering
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start(); // Start output buffering to prevent header issues

function handleLogin() {
    $error = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        // Basic validation
        if (empty($username) || empty($password)) {
            return 'Username and password are required.';
        }
        
        // Load user data
        try {
            $users = require DUMMIES_PATH . '/users.staticData.php';
        } catch (Exception $e) {
            return 'Error loading user data: ' . $e->getMessage();
        }
        
        // Check if users data is loaded
        if (empty($users)) {
            return 'User data could not be loaded.';
        }
        
        // Validate credentials
        foreach ($users as $user) {
            if ($user['username'] === $username && $user['password'] === $password) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['role'] = $user['role'];
                
                // Clean any output buffer and redirect
                ob_end_clean();
                header('Location: ../Homepage/index.php');
                exit();
            }
        }
        
        $error = 'Invalid username or password.';
    }
    
    return $error;
}

function renderLoginForm($error = '') {
    ?>
    <main>
        <div class="login-container">
            <div class="login-card">
                <h1>Login</h1>
                <form method="post" action="">
                    <div class="form-group">
                        <input type="text" name="username" placeholder="Username" class="form-input" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" placeholder="Password" class="form-input" required>
                    </div>
                    <button type="submit" class="login-submit">Login</button>
                </form>
                <?php if ($error): ?>
                    <div class="error-message"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php
}
?>
