<?php
session_start();
include 'config.php';

if(!isset($_SESSION['userid']))
{
    header('Location: login.html');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to external CSS file for styling -->
</head>
<body>
    <div id="navbar">
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="#">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
            <?php
            include  'config.php';
       
            $sql = "SELECT * FROM food";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='food-item'>";
                    echo "<h3>{$row['FoodName']}</h3>";
                    echo "<p>{$row['Price']}</p>";
                    echo "<label for='quantity{$row['FoodID']}'>Quantity:</label>";
                    echo "<input type='number' id='quantity{$row['FoodID']}' min='1' value='1'>";
                    echo "<button onclick='addToCart({$row['FoodID']}, \"{$row['FoodName']}\", {$row['Price']})'>Add to Cart</button>";
                    echo "</div>";
                }
                
            } else {
                echo "0 results";
            }

            // Close the database connection
            $conn->close();
            ?>
        </div>
        <div id="checkout">
            <h3>Checkout</h3>
            <div id="selected-items">
                
            </div>
            <p>Total: <span id="total-cost">0.00</span></p>
            <button onclick="payNow()">Pay Now</button>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
