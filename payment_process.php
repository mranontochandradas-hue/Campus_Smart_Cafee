<?php
session_start();
include "config.php";

if (!isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit();
}

$message = "";
$delivery_info = "";
$success = false;

if (isset($_SESSION['totalAmount']) && isset($_POST['amount'])) {

    $total_amount = floatval($_SESSION['totalAmount']);
    $given_amount = floatval($_POST['amount']);
    $method = isset($_POST['payment-method']) ? $_POST['payment-method'] : 'card';

    if ($given_amount < $total_amount) {
        $message = "Insufficient payment amount!";
    } else {

        $userID = intval($_SESSION['userid']);
        $sql = "SELECT * FROM userinformation WHERE UserID = $userID";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {

            $row = $result->fetch_assoc();
            $userName = $row['Name'];
            $userAddress = $row['Address'];
            $userMobile = $row['ContactNumber'];
            $userEmail = $row['Email'];

            $change = $given_amount - $total_amount;

            $message = "Thank you, your payment is successful.";
            $success = true;
              // doshomik er por koita sunno thabe 

            $delivery_info = "
                <h2>Delivery Information</h2>
                <p><strong>Name:</strong> $userName</p>
                <p><strong>Address:</strong> $userAddress</p>
                <p><strong>Mobile:</strong> $userMobile</p>
                <p><strong>Email:</strong> $userEmail</p>
                <p><strong>Total:</strong> " . number_format($total_amount, 2) . " Taka</p>
                <p><strong>Paid:</strong> " . number_format($given_amount, 2) . " Taka</p>
                <p><strong>Change:</strong> " . number_format($change, 2) . " Taka</p>
            ";

            // Save receipt data for receipt_pdf.php (FOR PDF)
            $_SESSION['receipt'] = [
                'userid'  => $userID,
                'name'    => $userName,
                'address' => $userAddress,
                'mobile'  => $userMobile,
                'email'   => $userEmail,
                'total'   => number_format($total_amount, 2),
                'paid'    => number_format($given_amount, 2),
                'change'  => number_format($change, 2),
                'method'  => strtoupper($method),
                'date'    => date('Y-m-d')   // date only
            ];

            // Clear total amount after success
            unset($_SESSION['totalAmount']);

        } else {
            $message = "User information not found!";
        }
    }

} else {
    header("Location: payment.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Payment Status</title>
<style>
    body{
        font-family:Arial,sans-serif;
        background:#f0f0f0;
        margin:0;
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
    }
    .container{
        background:#fff;
        padding:20px;
        border-radius:10px;
        box-shadow:0 0 10px rgba(0,0,0,.1);
        text-align:center;
        max-width:420px;
        width:100%;
    }
    .delivery-info{
        background:#f9f9f9;
        padding:10px;
        border-radius:5px;
        margin-top:15px;
        text-align:left;
    }
    .btn-row{
        display:flex;
        gap:10px;
        justify-content:center;
        margin-top:15px;
        flex-wrap:wrap;
    }
    .button{
        display:inline-block;
        text-decoration:none;
        color:#fff;
        padding:12px 18px;
        border-radius:6px;
        font-weight:bold;
    }
    .button:hover{opacity:0.9;}
    .btn-download{background:#28a745;}
    .btn-home{background:#007bff;}
    .btn-back{background:#6c757d;}
</style>
</head>
<body>

<div class="container">
    <h1>Payment Status</h1>
    <p><?php echo $message; ?></p>

    <?php if ($success): ?>
        <div class="delivery-info"><?php echo $delivery_info; ?></div>

        <div class="btn-row">
            <a href="receipt_pdf.php" class="button btn-download">Download PDF</a>
            <a href="dashboard.php" class="button btn-home">Back to Home</a>
        </div>
    <?php else: ?>
        <div class="btn-row">
            <a href="payment.php" class="button btn-back">Back</a>
        </div>
    <?php endif; ?>

</div>

</body>
</html>
