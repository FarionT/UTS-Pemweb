<?php
require_once('db.php');

if($_POST['password'] != $_POST['confirmpassword']) {
    header('location: register.php');
    die();
}

$username = strtolower($_POST['username']);
$namadepan = $_POST['namadepan'];
$namabelakang = $_POST['namabelakang'];
$pekerjaan = $_POST['pekerjaan'];
$email = $_POST['email'];
$tanggallahir = $_POST['tanggallahir'];
$password = $_POST['password'];
$role = "user";

if($_FILES['profile']['name'] == "") {
    $profile = "profile/default.png";
}
else {
    $filename = $_FILES['profile']['name'];
    $temp_file = $_FILES['profile']['tmp_name'];
    
    $file_ext = explode(".", $filename);
    $file_ext = end($file_ext);
    $file_ext = strtolower($file_ext);
        
    switch($file_ext){
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'svg':
        case 'webp':
        case 'bmp':
        case 'gif':
        case 'jfif':
            move_uploaded_file($temp_file, "profile/{$filename}");
            break;
        default: 
            header('location: register.php');
            die();
    }
    $profile = "profile/{$filename}";
}

$en_pass = password_hash($password, PASSWORD_BCRYPT);

if(isset($namabelakang) && !empty($namabelakang)) {
    $sql = "INSERT INTO user (username, password, namadepan, namabelakang, pekerjaan, email, tanggallahir, role, profile)
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)";
}
else {
    $sql = "INSERT INTO user (username, password, namadepan, namabelakang, pekerjaan, email, tanggallahir, role, profile)
        VALUES(?, ?, ?, NULL, ?, ?, ?, ?, ?)";
}

$result = $db->prepare($sql);
if(isset($namabelakang) && !empty($namabelakang)) {
    $result->execute([$username, $en_pass, $namadepan, $namabelakang, $pekerjaan, $email, $tanggallahir, $role, $profile]);
}
else {
    $result->execute([$username, $en_pass, $namadepan, $pekerjaan, $email, $tanggallahir, $role, $profile]);
}


header('location: login.php');