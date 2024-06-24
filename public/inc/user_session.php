<?php
session_start();
require_once '../connection/config.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE user='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['id'] = $row['id'];
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $row['name'];
            $_SESSION['post'] = $row['post'];
            $_SESSION['sede'] = $row['sede'];
            header("Location: ../index.php");
        } else {
            echo "Incorrect username or password";
        }
    } else {
        echo "User not found";
    }
}