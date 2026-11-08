<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include("dbcon.php");

if (!isset($_SESSION['email'])) {
    header('location:login.php');
    exit;
}

$amt = $_SESSION['total'] ?? 0;
if ($amt <= 0) {
    header('location:cart.php');
    exit;
}

if (isset($_POST["next"])) {
    header('location:printbill.php?order=true');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Payment - Chic Catering</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Open Sans', sans-serif;
            color: #333;
        }
        .payment-card {
            max-width: 650px;
            margin: 40px auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            overflow: hidden;
            border: 0;
        }
        .payment-header {
            background: linear-gradient(135deg, #81C408, #5a8e04);
            color: #fff;
            padding: 30px;
            text-align: center;
        }
        .method-card {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 15px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .method-card.active {
            border-color: #81C408;
            background-color: #f8fbf3;
        }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="payment-card">
        <div class="payment-header">
            <h2 class="text-white mb-1"><i class="fa fa-shield-alt me-2"></i>Secure Payment</h2>
            <p class="text-white-50 mb-0">Chic Catering Checkout System</p>
            <div class="mt-3">
                <span class="badge bg-white text-dark fs-5 px-4 py-2 rounded-pill">Total to Pay: ₹<?= number_format(floatval($amt), 2) ?></span>
            </div>
        </div>

        <div class="p-4 p-md-5">
            <form action="" method="POST" id="payment-form">
                <div class="mb-4">
                    <label class="form-label fw-bold mb-3">Select Payment Method</label>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="method-card active d-flex align-items-center w-100" for="pay_card">
                                <input class="form-check-input me-3" type="radio" name="payment_method" id="pay_card" checked>
                                <div>
                                    <span class="d-block fw-bold"><i class="fa fa-credit-card text-primary me-2"></i>Credit / Debit Card</span>
                                    <small class="text-muted">Visa, Mastercard, RuPay</small>
                                </div>
                            </label>
                        </div>
                        <div class="col-sm-6">
                            <label class="method-card d-flex align-items-center w-100" for="pay_upi">
                                <input class="form-check-input me-3" type="radio" name="payment_method" id="pay_upi">
                                <div>
                                    <span class="d-block fw-bold"><i class="fa fa-mobile-alt text-success me-2"></i>UPI / Net Banking</span>
                                    <small class="text-muted">GPay, PhonePe, Paytm</small>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <div id="card_details_section">
                    <div class="mb-3">
                        <label for="Cname" class="form-label fw-bold">Cardholder's Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="Cname" id="Cname" placeholder="Name as displayed on card" required autocomplete="cc-name">
                    </div>

                    <div class="mb-3">
                        <label for="cardnumber" class="form-label fw-bold">Card Number <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-credit-card"></i></span>
                            <input type="text" class="form-control" name="Cnum" id="cardnumber" placeholder="1234 5678 9012 3456" inputmode="numeric" maxlength="19" required autocomplete="cc-number">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="exp_date" class="form-label fw-bold">Expiry Date <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="exp_date" name="exp_date" placeholder="MM / YY" inputmode="numeric" maxlength="5" required autocomplete="cc-exp">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="verification" class="form-label fw-bold">CVV / CVC <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="verification" name="cvv" placeholder="•••" inputmode="numeric" maxlength="4" required autocomplete="cc-csc">
                        </div>
                    </div>
                </div>

                <div class="alert alert-light border d-flex align-items-center mt-3">
                    <i class="fa fa-lock fa-2x text-muted me-3"></i>
                    <small class="text-muted">Your payment details are processed through a 256-bit encrypted demonstration gateway. No actual money is deducted.</small>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary rounded-pill py-3 text-white fs-5 fw-bold" name="next">
                        <i class="fa fa-check-circle me-2"></i> Authorize & Pay ₹<?= number_format(floatval($amt), 2) ?>
                    </button>
                    <a href="checkout.php" class="btn btn-outline-secondary rounded-pill py-2 text-center">
                        <i class="fa fa-arrow-left me-1"></i> Back to Delivery Address
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
