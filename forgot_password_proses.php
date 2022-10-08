<?php
    session_start();
    require('db.php');
    $email = $_POST['email'];
    $oldpassword = $_POST['oldpassword'];
    $newpassword = $_POST['newpassword'];
    $confirmpassword = $_POST['confirmpassword'];

    if($newpassword != $confirmpassword || $oldpassword == $newpassword) {
        header('location: forgot_password.php');
        die();
    }

    $sql = "SELECT * FROM user
            WHERE email = ?";

    $stmt = $db->prepare($sql);
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $en_pass = password_hash($newpassword, PASSWORD_BCRYPT);

    if(!$row) {
        header('location: forgot_password.php');
        die();
    }
    else {
        if(!password_verify($oldpassword, $row['password'])) {
            header('location: forgot_password.php');
            die();
        }
        else {
            $sql1 = "UPDATE user
                    SET password = ?
                    WHERE email = '$email'";
            $stmt = $db->prepare($sql1);
            $stmt->execute([$en_pass]);
            header('location: login.php');
            die();
        }
    }
?>