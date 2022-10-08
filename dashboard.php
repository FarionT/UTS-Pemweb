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
        <link href="style.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>NgodingCoy</title>
</head>
<body>
    <nav class="shadow w-100 d-flex justify-content-between py-2">
        <a href="dashboard.php" class="ms-5"><img style="width: 190px; height: 50px;" src="img/logo.png"/></a>
        <div class="w-50 d-flex justify-content-between">
            <a href="#" class="h3 text-body text-decoration-none mt-2">ALL</a>
            <a href="#" class="h3 text-body text-decoration-none mt-2">C</a>
            <a href="#" class="h3 text-body text-decoration-none mt-2">PHP</a>
            <a href="#" class="h3 text-body text-decoration-none mt-2">Python</a>
            <a href="#" class="h3 text-body text-decoration-none mt-2">Java</a>
            <a href="#" class="h3 text-body text-decoration-none mt-2">Javascript</a>
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
                <a href="#"><img class="rounded-circle" src=<?=$row['profile']?> style="width: 50px;"/></a>
                <a href="#" class="h2 text-body text-decoration-none mt-2"><?=$row['username']?></a>
            <?php
            } else {
            ?>
            <a href="login.php" class="h2 text-body text-decoration-none mt-2">Log In</a>
            <?php
            }
            ?>
        </div>
    </nav>
    DASHBOARD CUY
    <footer class="d-flex justify-content-end" style="background-color: #D9D9D9; position: fixed;  bottom: 0; width: 100%;">
        <p class="mt-2 mb-3 me-5">Site design/logo by ©Ngoding Coy 2022 Inc</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="javascript.js"></script>
</body>
</html>