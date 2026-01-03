<?php

session_start();

if (!isset($_SESSION['userid'])) {
  
    header("Location: login.html");
    exit();
}


if (isset($_GET['total'])) {
    $_SESSION['totalAmount'] = $_GET['total'];
} else {
 
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>

        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
            font-size: 18px;
            color: #555;
        }

        .info-box {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 20px;
            text-align: left;
        }

        .info-box h2 {
            margin-bottom: 10px;
        }

        .info-box p {
            margin-bottom: 5px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        select,
        input[type="number"],
        button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        select:focus,
        input[type="number"]:focus,
        button:focus {
            outline: none;
            border-color: #4CAF50;
        }

        button {
            background-color:rgb(83, 76, 175);
            color: #fff;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment</h1>
        <!-- Display user delivery information -->
        <div class="info-box">
            <p><strong>Total Ammount:</strong> <?php echo $_GET['total'].' Taka'; ?></p>
        </div>
        <!-- Payment form -->
        <form action="payment_process.php" method="POST">
            <label for="payment-method">Select Payment Method:</label>
            <select name="payment-method" id="payment-method">
                <option value="bkash">bKash</option>
                <option value="nagad">Nagad</option>
                <option value="card">Card</option>
            </select>
            <label for="amount">Enter Payment Amount:</label>
            <input type="number" name="amount" id="amount" required>
            <button type="submit">Submit Payment</button>
        </form>
    </div>
</body>
</html>
