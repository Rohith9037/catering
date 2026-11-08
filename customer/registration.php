<?php 
require_once('../config/autoload.php'); 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$dao = new DataAccess();

$rules = array(
    'fname' => array('required' => true, 'minlength' => 2, 'maxlength' => 30),
    'lname' => array('required' => true, 'minlength' => 1, 'maxlength' => 30),
    'lemail' => array('required' => true, "unique" => array("field" => "lemail", "table" => "login")),
    'lpass' => array('required' => true, 'minlength' => 4),
    'cpass' => array("required" => true, "compare" => array("comparewith" => "lpass", "operator" => "=")),
    'lphno' => array('required' => true, "unique" => array("field" => "lphno", "table" => "login"), "maxlength" => 10, "minlength" => 10),
);

$labels = array('fname' => "First Name", 'lname' => "Last Name", "lemail" => "Email", "lpass" => "Password", "cpass" => "Confirm Password", "lphno" => "Phone Number");
$validator = new FormValidator($rules, $labels);

$elements = array(
    'fname' => '',
    'lname' => '',
    'lemail' => '',
    'lpass' => '',
    'lphno' => '',
    'cpass' => '',
);

$form = new FormAssist($elements, $_POST);

$errorMsg = "";
if (isset($_POST['signup'])) {
    if ($validator->validate($_POST)) {
        $data = array(
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'lemail' => $_POST['lemail'],
            'lpass' => $_POST['lpass'],
            'lphno' => $_POST['lphno'],
        );
        $table = 'login';
        if ($dao->insert($data, $table)) {
            echo "<script>alert('Account registered successfully! Please log in.'); window.location = 'login.php';</script>";
            exit;
        } else {
            $errorMsg = "Registration failed. Please verify your details.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration - Chic Catering</title>
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
            padding: 40px 15px;
        }
        .register-card {
            max-width: 580px;
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
    <div class="register-card">
        <div class="text-center mb-4">
            <a href="index.php" class="text-decoration-none">
                <i class="fa fa-dove brand-logo"></i>
                <h3 class="text-primary mb-1">Chic Catering</h3>
            </a>
            <p class="text-muted small">Create a new customer account to start booking event catering</p>
        </div>

        <?php if (!empty($errorMsg)): ?>
            <div class="alert alert-danger" role="alert">
                <i class="fa fa-exclamation-triangle me-2"></i><?= htmlspecialchars($errorMsg) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="registration.php">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="fname" class="form-label fw-bold small text-secondary">First Name <span class="text-danger">*</span></label>
                    <?= $form->textBox('fname', array('class' => 'form-control', 'id' => 'fname', 'placeholder' => 'Enter First Name', 'autocomplete' => 'given-name')); ?>
                    <span class="text-danger small"><?= $validator->error('fname'); ?></span>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lname" class="form-label fw-bold small text-secondary">Last Name <span class="text-danger">*</span></label>
                    <?= $form->textBox('lname', array('class' => 'form-control', 'id' => 'lname', 'placeholder' => 'Enter Last Name', 'autocomplete' => 'family-name')); ?>
                    <span class="text-danger small"><?= $validator->error('lname'); ?></span>
                </div>
            </div>

            <div class="mb-3">
                <label for="lemail" class="form-label fw-bold small text-secondary">Email Address <span class="text-danger">*</span></label>
                <?= $form->textBox('lemail', array('class' => 'form-control', 'id' => 'lemail', 'placeholder' => 'name@example.com', 'autocomplete' => 'email')); ?>
                <span class="text-danger small"><?= $validator->error('lemail'); ?></span>
            </div>

            <div class="mb-3">
                <label for="lphno" class="form-label fw-bold small text-secondary">Mobile Number (10 digits) <span class="text-danger">*</span></label>
                <?= $form->textBox('lphno', array('class' => 'form-control', 'id' => 'lphno', 'placeholder' => '10-digit mobile number', 'inputmode' => 'numeric', 'autocomplete' => 'tel')); ?>
                <span class="text-danger small"><?= $validator->error('lphno'); ?></span>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="lpass" class="form-label fw-bold small text-secondary">Password <span class="text-danger">*</span></label>
                    <?= $form->passwordBox('lpass', array('class' => 'form-control', 'id' => 'lpass', 'placeholder' => 'Create password', 'autocomplete' => 'new-password')); ?>
                    <span class="text-danger small"><?= $validator->error('lpass'); ?></span>
                </div>
                <div class="col-md-6 mb-4">
                    <label for="cpass" class="form-label fw-bold small text-secondary">Confirm Password <span class="text-danger">*</span></label>
                    <?= $form->passwordBox('cpass', array('class' => 'form-control', 'id' => 'cpass', 'placeholder' => 'Re-enter password', 'autocomplete' => 'new-password')); ?>
                    <span class="text-danger small"><?= $validator->error('cpass'); ?></span>
                </div>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" name="signup" class="btn btn-primary rounded-pill py-3 text-white fs-5 fw-bold shadow-sm">
                    <i class="fa fa-user-plus me-2"></i> Register Account
                </button>
            </div>

            <div class="text-center pt-3 border-top">
                <p class="small text-muted mb-2">Already have an account? <a href="login.php" class="text-primary fw-bold text-decoration-none">Sign in here</a></p>
                <a href="index.php" class="small text-secondary text-decoration-none"><i class="fa fa-arrow-left me-1"></i> Return to Homepage</a>
            </div>
        </form>
    </div>
</body>
</html>
