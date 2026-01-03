<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $type = $_POST['user_type'];  // student or faculty
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $pass = $_POST['password'];

    if ($type == "student") {

        $sql = "INSERT INTO userinformation 
                (Name, Address, Email, ContactNumber, Gender, DateOfBirth, Password) 
                VALUES ('$name', '$address', '$email', '$contact', '$gender', '$dob', '$pass')";
    }

    else if ($type == "faculty") {

        $sql = "INSERT INTO faculty 
                (Name, Address, Email, Contact, Gender, DateOfBirth, Password) 
                VALUES ('$name', '$address', '$email', '$contact', '$gender', '$dob', '$pass')";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Successfully Registered!";
    } else {
        echo "Database Error: " . $conn->error;
    }
}
?>
