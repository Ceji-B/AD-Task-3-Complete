<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start();

require_once COMPONENTS_PATH . '/errorHandler.component.php';

function handleLogin() {
    $error = '';
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        
        if (empty($username) || empty($password)) {
            return 'Username and password are required.';
        }
        
        try {
            $users = require DUMMIES_PATH . '/users.staticData.php';
        } catch (Exception $e) {
            handle500('Error loading user data: ' . $e->getMessage());
        }
        
        if (empty($users)) {
            handle500('User data could not be loaded.');
        }
        
        foreach ($users as $user) {
            if ($user['username'] === $username && $user['password'] === $password) {
                $_SESSION['username'] = $user['username'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['role'] = $user['role'];
                
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
