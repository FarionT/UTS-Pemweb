<?php
session_start();
require_once('db.php');
if(isset($_SESSION['user_role']) && !empty($_SESSION['user_role']) && $_SESSION['user_role'] == "ban") {
    header('location: banned.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>NgodingCoy</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body style="background-color: #D9D9D9;">
    <nav class="navbar navbar-expand-lg" style="background-color:white">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
        <a data-aos="fade-right" data-aos-duration="1000" href="index.php" class="ms-5 navbar-brand logo"><img style="width: 190px; height: 50px;" src="img/logo.png"/></a>
        <ul class="navbar-nav me-auto my-lg-0 col-6 navScroll navbar-nav-scroll d-flex justify-content-between mx-auto" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
                <a href="index.php?kategori=all" aria-current="page" class=" nav-link nav-scroll h3 text-decoration-none mt-2 text-hover" style="color:#FFB800;font-weight:bold;">ALL</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=C" class=" nav-link text-decoration-none mt-2 text-hover"style="color:black;">C</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=PHP" class="nav-link h3 text-decoration-none mt-2 text-hover"style="color:black;">PHP</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=Python" class= " nav-link h3 text-decoration-none mt-2 text-hover"style="color:black;">Python</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=Java" class=" nav-link h3 text-decoration-none mt-2 text-hover"style="color:black;">Java</a>
            </li>
            <li class="nav-item">
                <a href="kategori.php?kategori=Javascript" class="nav-link h3 text-decoration-none mt-2 text-hover"style="color:black;">Javascript</a>
            </li>


        </ul>
        <div class="d-flex me-5">
            <div class="profile d-flex my-auto align-middle"  data-aos="fade-down" data-aos-duration="1000">
                <?php
                if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { ?>
                    <a data-aos="fade-right" data-aos-duration="1000" href="#" class="h2 text-gradient text-decoration-none d-block align-middle glow-on-hover" data-bs-toggle="modal" data-bs-target="#modal_create">Create</a>
                <?php
                } else { ?>
                    <a data-aos="fade-right" data-aos-duration="1000" href="login.php" class="h2 text-gradient text-decoration-none d-block align-middle glow-on-hover">Create</a>
                <?php
                }
                ?>
                <h2 class="">&nbsp;|&nbsp;</h2>
                <?php
                if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { 
                    $sqlprofile = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}";
                    $result = $db->query($sqlprofile);
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                ?>
                    <a href="profile.php?id_user_profile=<?= $row['id'] ?>"><img class="align-middle rounded-circle " src=<?=$row['profile']?> style="width: 50px;"/></a>
                    <a  href="profile.php?id_user_profile=<?= $row['id'] ?>" class="align-middle h2 text-body text-decoration-none text-gradient"><?=$row['username']?></a>
                
                <?php
                } else {
                ?>
                    <a href="login.php" class="h2 text-gradient text-decoration-none d-block align-middle glow-on-hover">Log In</a>
                <?php
                }
                ?>
                </div>
            </div>
        
        </div>
    </div>
    </nav>
    <div class="container">
        <div class="d-flex justify-content-around body-login mt-5">
            <div class=" login-description" data-aos="zoom-in"data-aos-duration="1000" >
                <img style="height: 100px;" class="login-img" src="img/logo.png" />
                <p style="width: 88%;">Ngoding coy merupakan website yang dikembangkan sebagai forum bagi para programmer                
                    untuk saling berdiskusi serta berbagi pengetahuan
                    seputar dunia coding, jadilah bagian dari ngoding
                    coy untuk memperluas pengetahuan anda
                </p>
            </div>
            <div class="d-flex flex-column align-items-center p-5 login-form" data-aos="zoom-in"data-aos-duration="1000" style="width:40%; background-color: #F2F2F2; border: 1px solid #FFB800;border-bottom: 5px solid #FFB800; border-right: 5px solid #FFB800; border-radius: 15px;">
                <form action="login_proses.php" method="post" class="d-flex flex-column">
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="align-self-center mb-0" style="width: 150%;">Username</h5>
                        <input class="align-self-center mb-2" type="text" name="username" style="border: 0px; width: 150%;" />                        
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="align-self-center mb-0" style="width: 150%;">Password</h5>
                        <input class="align-self-center mb-3" type="password" name="password" style="border: 0px; width: 150%;" />
                    </div>
                    <button style="width: 150%; border-radius: 15px; font-size: 18px;" class="btn btn-warning align-self-center" type="submit">Masuk</button>
                </form>
                <form action="forgot_password.php" method="post" class="mb-3">
                    <button type="submit" style="border: 0px solid black;">Lupa password?</button>
                </form>
                <form action="register.php" method="post" class="d-flex flex-column align-items-center">
                    <button style="background-color: #D9D9D9; border: 0px; border-radius: 20px; width: 120px;" class="align-self-center p-1" type="submit">Daftar</button>
                </form>
            </div>
        </div>
    </div>
    <footer class="d-flex justify-content-end" style="background-color: #000000; position: fixed;  bottom: 0; width: 100%;">
        <p class="text-white mt-2 mb-3 me-5">Site design/logo by ©Ngoding Coy 2022 Inc</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="javascript.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>