<?php
session_start();
require_once('db.php');

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM user
        WHERE username = ?";

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
        date_default_timezone_set('Asia/Jakarta');
        $currentdate = "20" . date('y-m-d');
        $tanggalban = $row['tanggalban'];
        // echo $currentdate . "<br />";
        // echo $tanggalban;
        if(isset($tanggalban) && !empty($tanggalban) && $tanggalban < $currentdate && $row['role'] == "ban") {
            $sqlban = "UPDATE user
                    SET role = 'user',
                    tanggalban = NULL
                    WHERE id = {$row['id']}";
            $db->query($sqlban);

            $sql = "SELECT * FROM user
                WHERE username = ?";

            $stmt = $db->prepare($sql);
            $stmt->execute([$username]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
        }

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['user_role'] = $row['role'];
        header('location: index.php');
        die();
    }
}