<?php
session_start();
require('db.php');
if(isset($_SESSION['username']) && !empty($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM user WHERE username = ?";

    $stmt = $db->prepare($sql);
    $stmt->execute([$username]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ngoding Coy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body style="background-color:#D9D9D9">
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
        <div class="my-5 p-5" style=" height:200px;background-image:url('img/bg_profile.png');border-radius:20px;">

            <img src=<?= $row['profile'] ?> class="d-inline-block my-auto" style="width:10%" />

            <div class="d-inline-block">
                <?php
                if($row['namabelakang'] == NULL) {?>
                    <h4><?= $row['namadepan'] ?></h4>
                <?php
                } else {
                ?>
                    <h4><?= $row['namadepan'] . ' ' . $row['namabelakang']?></h4>    
                <?php
                }
                ?>
                <p><?= $row['pekerjaan'] ?></p>
            </div>
        </div>
        <div class="d-flex justify-content-around">
            <div id="kiri" style="width:70%" class="d-inline-block">
                <div class="bg-white p-3 mb-2" style="width:100%;height:auto">
                    <div class="d-flex">
                        <img src="img/default.png" class="d-inline-block align-middle" style="width:6%;height:6%"/>
                        <div>
                            <p class="mb-0 align-middle">Atong | PHP</p>
                            <p>05 - 10 - 2022 13:23</p>
                        </div>
                    </div>
                    <div>
                        <p>PHP adalah bahasa pemrograman yang diciptakan pada tahun 1995</p>
                    </div>
                    <div>
                        <p class="d-inline">❤️10</p>
                        <p class="d-inline">✉️3</p>
                    </div>
                </div>
                <div class="bg-white p-3 mb-2" style="width:100%;height:auto">
                    <div class="d-flex">
                        <img src="img/default.png" class="d-inline-block align-middle" style="width:6%;height:6%"/>
                        <div>
                            <p class="mb-0 align-middle">Atong | PHP</p>
                            <p>05 - 10 - 2022 13:23</p>
                        </div>
                    </div>
                    <div>
                        <p>PHP adalah bahasa pemrograman yang diciptakan pada tahun 1995</p>
                    </div>
                    <div>
                        <p class="d-inline">❤️10</p>
                        <p class="d-inline">✉️3</p>
                    </div>
                </div>
            </div>
            
            <div id="kanan"  style="width:25%;" class="justify-content-center">
                <div class="bg-white text-center mb-3 d-inline-block" style="width:100%">
                    <p>Postingan</p>
                    <p>1</p>
                </div>
                <br/>
                <div class="bg-white text-center d-inline-block" style="width:100%">
                    <p class="mt-3 mb-0">Username: <?= $row['username'] ?></p>
                    <p class="mb-0" >Email: <?= $row['email'] ?></p>
                    <p>Tanggal Lahir: <?= $row['tanggallahir'] ?></p>
                    <a href="#" class="text-body" style="text-decoration:none">✏️ Edit Profile</p>
                    <a href="logout.php" class="text-body" style="text-decoration:none">🚪➡ Log Out</p>
                </div>
            </div>
        </div>
    </div>
    <footer class="d-flex justify-content-end" style="background-color: #000000; position: fixed;  bottom: 0; width: 100%;">
        <p class="mt-2 mb-3 me-5">Site design/logo by ©Ngoding Coy 2022 Inc</p>
    </footer>
</body>
</html>