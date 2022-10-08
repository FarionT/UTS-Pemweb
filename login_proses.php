<?php
session_start();
require_once('db.php');

$username = $_POST['username'];
$password = $_POST['password'];

if($username == "admin") {
    $sql = "SELECT * FROM admin
        WHERE username = ?";
}
else {
    $sql = "SELECT * FROM user
        WHERE username = ?";
}

$stmt = $db->prepare($sql);
$stmt->execute([$username]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if(!$row) {
    header('location: login.php');
    die();
}
else {
    if(!password_verify($password, $row['password'])) {
        header('location: login.php');
        die();
    }
    else {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_role'] = $row['role'];
        header('location: dashboard.php');
        die();
    }
}