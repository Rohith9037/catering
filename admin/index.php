<?php
session_start();
if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === 'admin' && $password === '1234') {
        $_SESSION['admin'] = 'admin';
        echo "<script>alert('Login Successful'); window.location = 'menu_prj.php';</script>";
        exit;
    } else {
        $errorMsg = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Chic Catering</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assets/css/alogin.css">
</head>
<body>
    <div class="container">
        <div class="left-section">
            <i class="fa fa-user-circle"></i>
            <h3>Admin Portal</h3>
            <p style="color: #eee; font-size: 14px; margin-top: 10px;">Chic Catering Management</p>
        </div>
        <div class="right-section">
            <h3>Admin Login</h3>
            <?php if (isset($errorMsg)): ?>
                <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 15px; font-size: 14px;">
                    <i class="fa fa-exclamation-triangle"></i> <?= htmlspecialchars($errorMsg) ?>
                </div>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="form-group">
                    <label for="username" style="display:none;">Username</label>
                    <span class="input-icon"><i class="fa fa-user"></i></span>
                    <input class="form-control" type="text" id="username" placeholder="Username" name="username" required value="admin" autocomplete="username">
                </div>
                <div class="form-group">
                    <label for="password" style="display:none;">Password</label>
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                    <input class="form-control" type="password" id="password" placeholder="Password" name="password" required autocomplete="current-password">
                </div>
                <input type="submit" name="login" class="btn" value="LOGIN">
                <div class="forgot-pass" style="margin-top: 15px; text-align: center;">
                    <a href="../customer/index.php" style="color: #666; font-size: 13px; text-decoration: none;">
                        <i class="fa fa-arrow-left"></i> Back to Customer Site
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
