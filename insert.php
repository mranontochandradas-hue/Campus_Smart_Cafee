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
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style.css"> 
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        padding: 20px;
      }
      .container {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: auto;
      }
      input[type="text"],
      input[type="email"],
      input[type="tel"],
      input[type="date"],
      input[type="password"],
      select {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }
      input[type="submit"] {
        width: 100%;
        background-color: #4caf50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        cursor: pointer;
      }
      input[type="submit"]:hover {
        background-color: #45a049;
      }
    </style>
</head>
<body>
    <div id="navbar">
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="#">Add item</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $foodName = $_POST['foodName'];
    $price = $_POST['price'];
    
    
    $sql = "INSERT INTO food (FoodName, Price) VALUES ('$foodName', $price)";

 
    if (mysqli_query($conn, $sql)) {
  
        echo "<script>";
        echo "alert('Food item added successfully');";
        echo "window.location.href = 'admin.php';";
        echo "</script>";
    } else {
  
        echo "Error: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<div class="container">
      <h2>Edit Foood</h2>
      <form action="" method="POST">
        <label for="name">Food Name:</label>
        <input type="text" id="name" name="foodName" required/>

        <label for="address">Price</label>
        <input type="text" id="address" name="price" required/>
     

        
        <input type="submit" value="save" />
      </form>
    </div>