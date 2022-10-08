<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        <div class="d-flex my-4">
            <?php
            if($_GET['kategori'] == "c") {?>
                <img src="img/c.png" class="inline" style="width:200px;height:auto"/>
                <h3 class="inline align-self-center ">C</h3>
            <?php
            } else if($_GET['kategori'] == "php") {?>
                <img src="img/php.png" class="inline" style="width:200px;height:auto"/>
                <h3 class="inline align-self-center ">PHP</h3>
            <?php
            } else if($_GET['kategori'] == "python") {
            ?>
                <img src="img/python.png" class="inline" style="width:200px;height:auto"/>
                <h3 class="inline align-self-center ">Python</h3>
            <?php
            } else if($_GET['kategori'] == "java") {
            ?>
                <img src="img/java.png" class="inline" style="width:200px;height:auto"/>
                <h3 class="inline align-self-center ">Java</h3>
            <?php
            } else if($_GET['kategori'] == "javascript") {
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
                    <p>2</p>
                </div>
            </div>
            <div id="kategori_kanan" style="width:67%">
                <div class="bg-white p-3 mb-2 shadow-sm" style="width:100%;height:auto">
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
                <div class="bg-white p-3 mb-2 shadow-sm" style="width:100%;height:auto">
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
        </div>
        
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>