<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user']))
{
    header('Location: login.html');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to external CSS file for styling -->
</head>
<body>
    <div id="navbar">
        <ul>
            <li><a href="admin.php">Home</a></li>
            <li><a href="insert.php">Add item</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
            <?php
            include  'config.php';
      
            $sql = "SELECT * FROM food ORDER BY FoodName";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<div class='food-item'>";
                    echo "<h3>{$row['FoodName']}</h3>";
                    echo "<p>{$row['Price']}</p>";
                    echo '<a href="edit.php?food_id=' . $row['FoodID'] . '">Edit</a>'; 
                    echo '    ||   ';
                    echo '<a href="delete.php?food_id=' . $row['FoodID'] . '">Delete</a>'; 
                    echo "</div>";
                }
                
            } else {
                echo "0 results";
            }

            $conn->close();
            ?>
</body>
</html>
