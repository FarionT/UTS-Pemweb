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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
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
    <?php
    $id_post = $_GET['id_post'];
    $sqlpost = "SELECT * FROM postingan WHERE id = $id_post";
    $resultpost = $db->query($sqlpost);
    $rowpost = $resultpost->fetch(PDO::FETCH_ASSOC);
    $id_user = $rowpost['id_user'];
    $sqluser = "SELECT * FROM user WHERE id = $id_user";
    $resultuser = $db->query($sqluser);
    $rowuser = $resultuser->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="mx-auto container mt-3 col-6" style="background-color:white">
        <div class="d-inline-block align-self-start">
            <img src=<?= $rowuser['profile'] ?> style="width:60px;height:60px;"alt="">
        </div>
        <div class="d-inline-block">
            <a href="detail.php?id_post=<?= $rowpost['id'] ?>" class="fs-3 text-decoration-none" style="color:black"><?= $rowuser['username'] ?> | <?= $rowpost['kategori'] ?></a>
            <p><?= $rowuser['pekerjaan'] ?></p>
        </div>
        <div>
            <a href="detail.php?id_post=<?= $rowpost['id'] ?>" class="text-decoration-none" style="color:black"><b><?= $rowpost['subject'] ?></b></a>
        </div>
        <div class="">
            <?= $rowpost['konten'] ?>
        </div>
        <div><br>
            <p class="d-inline">❤️10</p>
            <p class="d-inline">✉️3</p>
        </div>
        <br>
        <div type="text" class="align-self-end">
            <form action="">
                <div class="row">
                    <div class="col-sm-11 flex-start">
                        <input type="text" class="form-control"placeholder="Comment">
                    </div>
                    <div class="col-sm">
                        <input type="image" src="img/send.png" style="width: 30px;height:20px;">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>