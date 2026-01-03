
<?php
session_start();
include 'config.php';

if(!isset($_SESSION['user']))
{
    header('Location: login.html');
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newPrice = $_POST['price'];
    $newFoodName = $_POST['foodName'];
    $idd= $_POST['id'];

    $sql = "UPDATE food SET FoodName = '$newFoodName', Price = $newPrice WHERE FoodID  = $idd"; 
    if (mysqli_query($conn, $sql)) {
        echo "<script>";
        echo "alert('Food Item updated successfully');";
        echo "window.location.href = 'admin.php';";
        echo "</script>";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}


$id = $_GET['food_id']; 
$sql = "SELECT * FROM food WHERE FoodID  = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $currentFoodName = $row['FoodName'];
    $currentprice = $row['Price'];
} else {
    echo "0 results";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Page</title>
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
    <div class="container">
      <h2>Edit Foood</h2>
      <form action="" method="POST">
        <label for="name">Food Name:</label>
        <input type="text" id="name" name="foodName" required value ='<?php echo $currentFoodName; ?>'/>

        <label for="address">Price</label>
        <input type="text" id="address" name="price" required value ='<?php echo $currentprice; ?>'/>
       <input type="hidden" id="address" name="id" required value='<?php echo $id; ?>'>

        
        <input type="submit" value="Update" />
      </form>
    </div>
  </body>
</html>
