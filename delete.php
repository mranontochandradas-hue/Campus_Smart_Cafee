<?php

session_start();
include 'config.php';

if(!isset($_SESSION['user']))
{
    header('Location: login.html');
}

if(isset($_GET['food_id'])) {
    $id = $_GET['food_id'];

    $sql = "DELETE FROM food WHERE FoodID = $id"; 
    if (mysqli_query($conn, $sql)) {
        echo "<script>";
        echo "alert('Food item deleted successfully');";
        echo "window.location.href = 'admin.php';";
        echo "</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "No ID provided for deletion";
}


mysqli_close($conn);
?>
