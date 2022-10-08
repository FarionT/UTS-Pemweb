<?php
session_start();
require_once('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body style="background-color:#d9d9d9">
    <nav class="shadow w-100 d-flex justify-content-between py-2" style="background-color: #FFFFFF";>
        <a href="dashboard.php" class="ms-5"><img style="width: 190px; height: 50px;" src="img/logo.png"/></a>
        <div class="w-50 d-flex justify-content-between">
            <a href="dashboard.php" class="h3 text-body text-decoration-none mt-2">ALL</a>
            <a href="kategori.php?kategori=c" class="h3 text-body text-decoration-none mt-2">C</a>
            <a href="kategori.php?kategori=php" class="h3 text-body text-decoration-none mt-2">PHP</a>
            <a href="kategori.php?kategori=python" class="h3 text-body text-decoration-none mt-2">Python</a>
            <a href="kategori.php?kategori=java" class="h3 text-body text-decoration-none mt-2">Java</a>
            <a href="kategori.php?kategori=javascript" class="h3 text-body text-decoration-none mt-2">Javascript</a>
        </div>
        <div class="d-flex me-5">
            <a href="#" class="h2 text-body text-decoration-none mt-2">Create</a>
            <h2 class="mt-2">&nbsp;|&nbsp;</h2>
            <?php
            if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { 
                $sqlprofile = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}";
                $result = $db->query($sqlprofile);
                $row = $result->fetch(PDO::FETCH_ASSOC)
            ?>
                <a href="profile.php"><img class="rounded-circle" src=<?=$row['profile']?> style="width: 50px;"/></a>
                <a href="profile.php" class="h2 text-body text-decoration-none mt-2"><?=$row['username']?></a>
            <?php
            } else {
            ?>
            <a href="login.php" class="h2 text-body text-decoration-none mt-2">Log In</a>
            <?php
            }
            ?>
        </div>
    </nav>
    <div class="container">
        <div class="d-flex flex-column align-items-center p-3 mt-4 mx-auto" style="width:60%; background-color: #F2F2F2; border: 1px solid #FFB800;border-bottom: 5px solid #FFB800; border-right: 5px solid #FFB800; border-radius: 15px;">
            <img src="<?= $row['profile']?>" style="width:100px;height:auto" class="my-4"/>
            <form action="edit_account_process.php" method="post" class="d-flex flex-column"enctype="multipart/form-data">
                <input value="<?= $row['id']?>" name="id" hidden/>
                <input value="<?= $row['profile']?>" name="profile" hidden/>
                
                <div class="d-flex flex-column align-items-start">
                    <h5 class="align-self-center mb-0" style="width: 100%;">Username</h5>
                    <input required class="align-self-center mb-2" type="text" name="username" style="border: 0px; width: 100%;" value="<?= $row['username']?>"/>                        
                </div>
                <div class="d-flex">
                    <div class="d-flex flex-column align-items-start me-5" style="width: 150%;">
                        <h5 class="align-self-start mb-0">Nama Depan</h5>
                        <input required class="align-self-center mb-2" type="text" name="namadepan" style="border: 0px;" value="<?= $row['namadepan']?>"/>                        
                    </div>
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="align-self-start mb-0">Nama Belakang</h5>
                        <input class="align-self-center mb-2" type="text" name="namabelakang" style="border: 0px;" value="<?= $row['namabelakang']?>"/>                        
                    </div>
                </div>
                <div class="d-flex flex-column align-items-start">
                    <h5 class="align-self-center mb-0" style="width: 100%;">Pekerjaan</h5>
                    <input required class="align-self-center mb-2" type="text" name="pekerjaan" style="border: 0px; width: 100%;" value="<?= $row['pekerjaan']?>"/>                        
                </div>
                <div class="d-flex flex-column align-items-start">
                    <h5 class="align-self-center mb-0" style="width: 100%;">Email</h5>
                    <input required class="align-self-center mb-2" type="text" name="email" style="border: 0px; width: 100%;" value="<?= $row['email']?>"/>                        
                </div>
                <div class="d-flex flex-column align-items-start">
                    <h5 class="align-self-center mb-0" style="width: 100%;">Tanggal Lahir</h5>
                    <input required class="align-self-center mb-2" type="date" name="tanggallahir" style="border: 0px; width: 100%;" value="<?= $row['tanggallahir']?>"/>                        
                </div>
                <div class="d-flex flex-column align-items-start">
                    <h5 class="align-self-center mb-0" style="width: 100%;">Profile</h5>
                    <input class="btn btn-warning bg-warning align-self-center mb-2" type="file" name="profile2" style="border: 0px; width: 100%;" />                        
                </div>
                <div class="d-flex flex-column">
                    <h5 class="align-self-center mb-0" style="width: 100%;">Password</h5>
                   <input required class="align-self-center mb-3" type="password" name="password" style="border: 0px; width: 100%;" />
                </div>
                <div class="d-flex flex-column">
                    <h5 class="align-self-center mb-0" style="width: 100%;">Confirm Password</h5>                        
                    <input required class="align-self-center mb-3" type="password" name="confirmpassword" style="border: 0px; width: 100%;" />
                </div>
                <button style="width: 100%; border-radius: 15px; font-size: 18px;" class="btn btn-warning align-self-center" type="submit">Save</button>
            </form>
            <form action="forgot_password.php" method="post" class="mb-3">
                <button type="submit" style="border: 0px solid black;">Lupa password?</button>
            </form>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="javascript.js"></script>
</body>
</html>