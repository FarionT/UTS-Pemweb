<?php
session_start();
require('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NgodingCoy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body style="background-color:#D9D9D9">
    <nav class="shadow w-100 d-flex justify-content-between py-2" style="background-color: #FFFFFF";>
        <a href="dashboard.php" class="ms-5"><img style="width: 190px; height: 50px;" src="img/logo.png"/></a>
        <div class="w-50 d-flex justify-content-between">
            <a href="dashboard.php" class="h3 text-body text-decoration-none mt-2">ALL</a>
            <a href="kategori.php?kategori=C" class="h3 text-body text-decoration-none mt-2">C</a>
            <a href="kategori.php?kategori=PHP" class="h3 text-body text-decoration-none mt-2">PHP</a>
            <a href="kategori.php?kategori=Python" class="h3 text-body text-decoration-none mt-2">Python</a>
            <a href="kategori.php?kategori=Java" class="h3 text-body text-decoration-none mt-2">Java</a>
            <a href="kategori.php?kategori=Javascript" class="h3 text-body text-decoration-none mt-2">Javascript</a>
        </div>
        <div class="d-flex me-5">
            <?php
            if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
                <a href="#" class="h2 text-body text-decoration-none mt-2" data-bs-toggle="modal" data-bs-target="#modal_create">Create</a>
            <?php
            } else { ?>
                <a href="login.php" class="h2 text-body text-decoration-none mt-2">Create</a>
            <?php
            }
            ?>
            <h2 class="mt-2">&nbsp;|&nbsp;</h2>
            <?php
            if(isset($_SESSION['username']) && !empty($_SESSION['username']) && $_SESSION['user_role'] == "user") { 
                $sqlprofile = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}";
                $result = $db->query($sqlprofile);
                $row = $result->fetch(PDO::FETCH_ASSOC);
            ?>
                <a href="profile.php"><img class="rounded-circle" src=<?=$row['profile']?> style="width: 50px;"/></a>
                <a href="profile.php" class="h2 text-body text-decoration-none mt-2"><?=$row['username']?></a>
            <?php
            } else if(isset($_SESSION['username']) && !empty($_SESSION['username']) && $_SESSION['user_role'] == "admin") {
                $sqlprofile = "SELECT * FROM admin WHERE id = {$_SESSION['user_id']}";
                $result = $db->query($sqlprofile);
                $row = $result->fetch(PDO::FETCH_ASSOC);
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
        <div class="d-flex my-4">
            <?php
            $kategori = $_GET['kategori'];
            if($_GET['kategori'] == "C") {?>
                <img src="img/c.png" class="inline" style="width:200px;height:auto"/>
                <h3 class="inline align-self-center ">C</h3>
            <?php
            } else if($_GET['kategori'] == "PHP") {?>
                <img src="img/php.png" class="inline" style="width:200px;height:auto"/>
                <h3 class="inline align-self-center ">PHP</h3>
            <?php
            } else if($_GET['kategori'] == "Python") {
            ?>
                <img src="img/python.png" class="inline" style="width:200px;height:auto"/>
                <h3 class="inline align-self-center ">Python</h3>
            <?php
            } else if($_GET['kategori'] == "Java") {
            ?>
                <img src="img/java.png" class="inline" style="width:200px;height:auto"/>
                <h3 class="inline align-self-center ">Java</h3>
            <?php
            } else if($_GET['kategori'] == "Javascript") {
            ?>
                <img src="img/javascript.png" class="inline" style="width:200px;height:auto"/>
                <h3 class="inline align-self-center ">Javascript</h3>
            <?php
            }
            ?>
        </div>
        <div class="d-flex justify-content-between">
            <div id="kategori_kiri" style="width:30%">
                <div  class="bg-white text-center shadow-sm">
                    <p>Postingan</p>
                    <?php
                    $sqlpostingan = "SELECT COUNT(*) as jumlah FROM postingan WHERE kategori = '$kategori'";
                    $resultpostingan = $db->query($sqlpostingan);
                    $rowpostingan = $resultpostingan->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <p><?= $rowpostingan['jumlah'] ?></p>
                </div>
            </div>
            <?php
            
            $sqlpost = "SELECT * FROM postingan WHERE kategori = '$kategori'";
            $resultpost = $db->query($sqlpost);
            while($rowpost = $resultpost->fetch(PDO::FETCH_ASSOC)) {
                $id_user = $rowpost['id_user'];
                $sqluser = "SELECT * FROM user WHERE id = $id_user";
                $resultuser = $db->query($sqluser);
                $rowuser = $resultuser->fetch(PDO::FETCH_ASSOC);
            ?>
            <div class="container col-6 mt-5 pb-2" style="background-color:white;margin-top:10px;">      
                <div class="mx-auto">
                    <img src=<?=$rowuser['profile']?> style="width:60px;height:60px;" class="d-inline-block my-auto"alt="">
                    <div class="d-inline-block align-middle ">
                        <a href="#" class="fs-3 text-decoration-none" style="color:black"><?= $rowuser['username'] ?> | <?= $rowpost['kategori'] ?></a>
                        <p><?=$row['pekerjaan']?></p>
                    </div>
                </div>
                <a href="#" class="text-decoration-none" style="color:black"><b><?= $rowpost['subject'] ?></b></a>
                <div><?= $rowpost['konten'] ?></div>
                <div><br>
                    <p class="d-inline">❤️10</p>
                    <p class="d-inline">✉️3</p>
                    <a data-bs-toggle="modal" data-bs-target="#myModal" class="text-body text-decoration-none" href="#">&nbsp; Detail</a>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    <footer class="d-flex justify-content-end" style="background-color: #000000; position: fixed;  bottom: 0; width: 100%;">
        <p class="text-white mt-2 mb-3 me-5">Site design/logo by ©Ngoding Coy 2022 Inc</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="javascript.js"></script>
</body>
</html>