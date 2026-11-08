<?php 
require_once('../config/autoload.php'); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$dao = new DataAccess();

$rules = array(
    'lemail' => array('required' => true),
    'lpass' => array('required' => true)
);
$validator = new FormValidator($rules);

$errorMsg = "";
if (isset($_POST['signin'])) {
    if ($validator->validate($_POST)) {
        $data = array(
            'lemail' => $_POST['lemail'],
            'lpass' => $_POST['lpass']
        );
        $table = 'login';
        if ($info = $dao->login($data, $table)) {
            $_SESSION['email'] = $info['lemail'];
            echo "<script>alert('Login Successful'); window.location = 'index.php';</script>";
            exit;
        } else {
            $errorMsg = "Invalid email address or password.";
        }
    } else {
        $errorMsg = "Please fill in all required fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login - Chic Catering</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f7fbf2, #e8f4d9);
            font-family: 'Open Sans', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .login-card {
            max-width: 440px;
            width: 100%;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            padding: 40px;
            border: 0;
        }
        .brand-logo {
            color: #81C408;
            font-size: 38px;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <a href="index.php" class="text-decoration-none">
                <i class="fa fa-dove brand-logo"></i>
                <h3 class="text-primary mb-1">Chic Catering</h3>
            </a>
            <p class="text-muted small">Sign in to your customer account</p>
        </div>

        <?php if (!empty($errorMsg)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa fa-exclamation-triangle me-2"></i><?= htmlspecialchars($errorMsg) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="mb-3">
                <label for="lemail" class="form-label fw-bold small text-secondary">Email Address <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted"><i class="fa fa-envelope"></i></span>
                    <input type="email" class="form-control" id="lemail" name="lemail" placeholder="name@example.com" value="<?= htmlspecialchars($_POST['lemail'] ?? '') ?>" required autocomplete="email" autofocus>
                </div>
            </div>

            <div class="mb-4">
                <label for="lpass" class="form-label fw-bold small text-secondary">Password <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text bg-light text-muted"><i class="fa fa-lock"></i></span>
                    <input type="password" class="form-control" id="lpass" name="lpass" placeholder="Enter password" required autocomplete="current-password">
                </div>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" name="signin" class="btn btn-primary rounded-pill py-3 text-white fs-5 fw-bold shadow-sm">
                    <i class="fa fa-sign-in-alt me-2"></i> Log In
                </button>
            </div>

            <div class="text-center pt-3 border-top">
                <p class="small text-muted mb-2">Don't have an account yet? <a href="registration.php" class="text-primary fw-bold text-decoration-none">Create an account</a></p>
                <a href="index.php" class="small text-secondary text-decoration-none"><i class="fa fa-arrow-left me-1"></i> Return to Homepage</a>
            </div>
        </form>
    </div>
</body>
</html>
