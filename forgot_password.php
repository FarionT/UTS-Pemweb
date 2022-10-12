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
    <?php require_once('navbar.php'); ?>
    <div class="container">
        <div class="d-flex justify-content-around mt-5">
            <div class="w-50">
                <img style="height: 100px;" src="img/logo.png" />
                <p style="width: 58%">Ngoding coy merupakan website yang
                    dikembangkan sebagai forum bagi para programmer                
                    untuk saling berdiskusi serta berbagi pengetahuan
                    seputar dunia coding, jadilah bagian dari ngoding
                    coy untuk memperluas pengetahuan anda
                </p>
            </div>
            <div class="d-flex flex-column align-items-center p-5" style="width: 35%; background-color: #F2F2F2; border: 1px solid #FFB800;border-bottom: 5px solid #FFB800; border-right: 5px solid #FFB800; border-radius: 15px;">
                <form action="forgot_password_proses.php" method="post" class="d-flex flex-column">
                    <div class="d-flex flex-column align-items-start">
                        <h5 class="align-self-center mb-0" style="width: 150%;">Email</h5>
                        <input required class="align-self-center mb-2" type="text" name="email" style="border: 0px; width: 150%;" />                        
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="align-self-center mb-0" style="width: 150%;">Old Password</h5>
                        <input required class="align-self-center mb-3" type="password" name="oldpassword" style="border: 0px; width: 150%;" />
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="align-self-center mb-0" style="width: 150%;">New Password</h5>
                        <input required class="align-self-center mb-3" type="password" name="newpassword" style="border: 0px; width: 150%;" />
                    </div>
                    <div class="d-flex flex-column">
                        <h5 class="align-self-center mb-0" style="width: 150%;">Confirm Password</h5>
                        <input required class="align-self-center mb-3" type="password" name="confirmpassword" style="border: 0px; width: 150%;" />
                    </div>
                    <button style="width: 150%; border-radius: 15px; font-size: 18px;" class="btn btn-warning align-self-center" type="submit">Confirm</button>
                </form>
            </div>
        </div>
    </div>
    <footer class="d-flex justify-content-end" style="background-color: #D9D9D9; position: fixed;  bottom: 0; width: 100%;">
        <p class="mt-2 mb-3 me-5">Site design/logo by ©Ngoding Coy 2022 Inc</p>
    </footer>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="javascript.js"></script>
</body>
</html>