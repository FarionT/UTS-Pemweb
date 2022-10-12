<?php
session_start();
require_once('db.php');

if($_POST['password'] != $_POST['confirmpassword']) {
    header('location: edit_account.php');
    die();
}

$id = $_POST['id'];
$username = strtolower($_POST['username']);
$namadepan = $_POST['namadepan'];
$namabelakang = $_POST['namabelakang'];
$pekerjaan = $_POST['pekerjaan'];
$email = $_POST['email'];
$tanggallahir = $_POST['tanggallahir'];
$password = $_POST['password'];
$profile = $_POST['profile'];

if($_FILES['profile']['name'] != "") {
    $filename = $_FILES['profile2']['name'];
    $temp_file = $_FILES['profile2']['tmp_name'];

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
            header('location: edit_account.php');
            die();
    }
    $profile = "profile/{$filename}";
}
else {
    $profile = $_POST['profile'];
}

$en_pass = password_hash($password, PASSWORD_BCRYPT);

if(isset($namabelakang) && !empty($namabelakang)) {
    $sql = "UPDATE user 
            SET username = ?, 
                namadepan = ?, 
                namabelakang = ?, 
                pekerjaan = ?, 
                email = ?, 
                tanggallahir = ?, 
                profile = ?
            WHERE id = $id";
}
else {
    $sql = "UPDATE user 
            SET username = ?, 
                namadepan = ?, 
                namabelakang = NULL, 
                pekerjaan = ?, 
                email = ?, 
                tanggallahir = ?, 
                profile = ?
            WHERE id = $id";
}

$result = $db->prepare($sql);
if(isset($namabelakang) && !empty($namabelakang)) {
    $result->execute([$username, $namadepan, $namabelakang, $pekerjaan, $email, $tanggallahir, $profile]);
}
else {
    $result->execute([$username, $namadepan, $pekerjaan, $email, $tanggallahir, $profile]);
}


header('location: profile.php?id_user_profile='.$id);