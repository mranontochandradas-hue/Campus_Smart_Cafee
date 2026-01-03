<?php
session_start();
include "config.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Username input in login.html uses name="email"
    $loginInput = isset($_POST['email']) ? trim($_POST['email']) : "";
    $pass       = isset($_POST['password']) ? $_POST['password'] : "";

    // IMPORTANT: your form is sending user_type (as shown in your screenshot)
    $userType   = isset($_POST['user_type']) ? $_POST['user_type'] : "";

    // ---------- ADMIN (plain) ----------
    if ($userType === "admin") {

        $sql = "SELECT * FROM admin WHERE username='$loginInput' AND password='$pass' LIMIT 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['user'] = $row['username'];
            $_SESSION['name'] = $row['Name'];
            header("Location: admin.php");
            exit();
        } else {
            echo "Wrong information";
            exit();
        }
    }

    // ---------- STUDENT / FACULTY (hashed) ----------
    $sql = "SELECT * FROM userinformation WHERE Email='$loginInput' LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($pass, $row['Password'])) {
            $_SESSION['userid'] = $row['UserID'];
            $_SESSION['name']   = $row['Name'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Wrong information";
            exit();
        }
    } else {
        echo "Wrong information";
        exit();
    }
}
?>
