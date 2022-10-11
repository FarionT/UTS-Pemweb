<?php
session_start();
require('db.php');

if(isset($_GET['id_user']) && !empty($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
}
else if(isset($_POST['id_user']) && !empty($_POST['id_user'])) {
    $id_user = $_POST['id_user'];
    $sqlpost = "SELECT * FROM postingan WHERE id_user = ?";
    $stmtpost = $db->prepare($sqlpost);
    $stmtpost->execute([$id_user]);
    while($rowpost = $stmtpost->fetch(PDO::FETCH_ASSOC)) {
        $sql = "SELECT * FROM comment WHERE id_post = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$rowpost['id']]);
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $query1 = "DELETE FROM likecomment WHERE id_comment = ?";
            $result = $db->prepare($query1);
            $result->execute([$row['id']]);

            $query2 = "DELETE FROM comment WHERE id = ?";
            $result2 = $db->prepare($query2);
            $result2->execute([$row['id']]);  
        }

        $query3 = "DELETE FROM likepost WHERE id_post = ?";
        $result3 = $db->prepare($query3);
        $result3->execute([$rowpost['id']]);
 
        $query4 = "DELETE FROM postingan WHERE id = ?";
        $result4 = $db->prepare($query4);
        $result4->execute([$rowpost['id']]);
    }
        $query1 = "DELETE FROM likecomment WHERE id_user = ?";
        $result = $db->prepare($query1);
        $result->execute([$id_user]);

        $query2 = "DELETE FROM comment WHERE id_user = ?";
        $result2 = $db->prepare($query2);
        $result2->execute([$id_user]);

        $query3 = "DELETE FROM likepost WHERE id_user = ?";
        $result3 = $db->prepare($query3);
        $result3->execute([$id_user]);
    
        $query5 = "DELETE FROM user WHERE id = ?";
        $result5 = $db->prepare($query5);
        $result5->execute([$id_user]);
    header("Location: dashboard.php");
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
<body style="background-color:#D9D9D9">
    <nav class="navbar navbar-expand-lg" style="background-color:white">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
        <a data-aos="fade-right" data-aos-duration="1000" href="dashboard.php" class="ms-5 navbar-brand logo"><img style="width: 190px; height: 50px;" src="img/logo.png"/></a>
        <ul class="navbar-nav me-auto my-lg-0 col-6 navScroll navbar-nav-scroll d-flex justify-content-between mx-auto" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
                <a href="dashboard.php?kategori=all" aria-current="page" class=" nav-link nav-scroll h3 text-decoration-none mt-2 text-hover" style="color:#FFB800;font-weight:bold;">ALL</a>
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
        <div class="mt-2 bg-img p-5 d-flex rounded" data-aos="zoom-in-left" data-aos-duration="1000"style=" height:200px;background-image:url('img/Group 14.png');background-size: 1300px 200px;border-radius:20px;border:3px white solid;">
            <?php
            if(isset($_GET['id_user']) && !empty($_GET['id_user'])) {
                $id_user_profile = $_GET['id_user'];
                $sql = "SELECT 
                        id,
                        username,
                        namadepan,
                        namabelakang,
                        pekerjaan,
                        email,
                        CONCAT(DAY(tanggallahir), ' ', MONTHNAME(tanggallahir), ' ', YEAR(tanggallahir)) AS tanggallahir,
                        role,
                        profile
                        FROM user WHERE id = ?";
                $stmt = $db->prepare($sql);
                $stmt->execute([$id_user]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            ?>
            <img src=<?= $row['profile'] ?> class="d-block rounded-circle align-middle my-auto profileImg" />

            <div class="d-block ms-3">
                <?php
                    if($row['namabelakang'] == NULL) {?>
                        <b><h3><?= $row['namadepan'] ?></h3></b>
                        <?php
                    } else { ?>
                        <b><h3><?= $row['namadepan'] . ' ' . $row['namabelakang']?></h3></b>    
                    <?php
                    }
                    ?>
                    <p style="font-size:20px"><?= $row['pekerjaan'] ?></p>
            </div>
        </div>
        <div class="container text-center bg-white col-6 my-5 p-2" style="border-radius: 15px;" data-aos="fade-up" data-aos-duration="1300">
            <h3>Are you sure to delete this user?</h3>  
            <div class="">
                <form action="delete_user.php" method="post" class="d-inline-block">
                    <input hidden name="id_user" value='<?= $row['id']?>' />
                    <button class="btn btn-danger">Yes</button>
                </form>
                <button class="btn btn-primary" onclick="history.back()">No</button>
            </div>
        </div>
    </div>

<!--modal postingan  -->
<div class="modal fade" id="modal_create" style="border: 1px solid;padding: 10px;box-shadow: 5px 10px red;border-radius:10px;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container">
                        <div class="mx-auto container">
                            <h1>Create Post</h1>
                            <form action="create_post_proses.php" method="post" class="mx-auto my-auto">
                                <div class="mb-4">
                                    <label for="">Subject</label>
                                    <input required type="text" name="subject" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="">Konten</label>
                                    <textarea required type="text" name="konten" class="form-control" rows="3"></textarea>
                                </div>
                                <label for="">Category</label>
                                    <select name="kategori" class="form-select"><br>
                                        <option value="C">C</option>
                                        <option value="PHP">PHP</option>
                                        <option value="Python">Python</option>
                                        <option value="Java">Java</option>
                                        <option value="Javascript">Javascript</option>
                                    </select>
                                    <br>
                                <div class="d-flex justify-content-center">
                                    <button type="submit" class="btn btn-warning mb-2" style="width: 50%;">Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
