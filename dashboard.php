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
<body style="background-color: #D9D9D9;">
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
            if(isset($_SESSION['username']) && !empty($_SESSION['username'])) { 
                $sqlprofile = "SELECT * FROM user WHERE id = {$_SESSION['user_id']}";
                $result = $db->query($sqlprofile);
                $row = $result->fetch(PDO::FETCH_ASSOC);
            ?>
                <a href="profile.php?id_user_profile=<?= $row['id'] ?>"><img class="rounded-circle" src=<?=$row['profile']?> style="width: 50px;"/></a>
                <a href="profile.php?id_user_profile=<?= $row['id'] ?>" class="h2 text-body text-decoration-none mt-2"><?=$row['username']?></a>
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
    $sqlpost = "SELECT 
                id, 
                subject, 
                konten, 
                kategori, 
                CONCAT(DAY(tanggal), ' ', MONTHNAME(tanggal), ' ', YEAR(tanggal)) AS tanggal, 
                LEFT(jam, 5) AS jam, 
                id_user, 
                (SELECT COUNT(*) FROM likepost GROUP BY id_post HAVING id_post = id ) * 0.3 + 
                (SELECT COUNT(*) FROM comment GROUP BY id_post HAVING id_post = id ) * 0.7 AS trend
                FROM postingan
                ORDER BY trend DESC";
    $resultpost = $db->query($sqlpost);
    while($rowpost = $resultpost->fetch(PDO::FETCH_ASSOC)) {
        $id_user = $rowpost['id_user'];
        $sqluser = "SELECT * FROM user WHERE id = $id_user";
        $resultuser = $db->query($sqluser);
        $rowuser = $resultuser->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="container col-6 mt-5 pb-2" style="background-color:white;margin-top:10px;">      
        <div class="mx-auto d-flex justify-content-between align-middle">
            <div class="d-inline-block">
                <a href="profile.php?id_user_profile=<?= $rowuser['id'] ?>"><img src=<?=$rowuser['profile']?> style="width:60px;height:60px;" class="d-inline-block my-auto"alt=""></a>
                <div class="d-inline-block align-middle ">
                    <a href="profile.php?id_user_profile=<?= $rowuser['id'] ?>" class="fs-3 text-decoration-none" style="color:black"><?= $rowuser['username'] ?> | <?= $rowpost['kategori'] ?></a>
                    <p><?=$rowuser['pekerjaan']?></p>
                </div>
            </div>
            
            <div class="">
                <p class="mt-2"><?= $rowpost['tanggal']?> <?= $rowpost['jam']?></p>
            </div>
        </div>
        <div>
            <a href="detail.php?id_post=<?= $rowpost['id'] ?>" class="text-decoration-none" style="color:black"><b><?= $rowpost['subject'] ?></b></a>
        <div><?= $rowpost['konten'] ?></div>
        <div class="d-flex justify-content-between">
            <div>
                <?php
                    $sqljumlahcomment = "SELECT COUNT(*) AS jumlah FROM comment WHERE id_post = {$rowpost['id']}";
                    $resultjumlahcomment = $db->query($sqljumlahcomment);
                    $rowjumlahcomment = $resultjumlahcomment->fetch(PDO::FETCH_ASSOC);

                    $sqljumlahlike = "SELECT COUNT(*) AS jumlah FROM likepost WHERE id_post = {$rowpost['id']}";
                    $resultjumlahlike = $db->query($sqljumlahlike);
                    $rowjumlahlike = $resultjumlahlike->fetch(PDO::FETCH_ASSOC);

                    if(isset($_SESSION['username']) && !empty($_SESSION['username']) && $_SESSION['user_role'] == "user") {
                        $sqlusernow = "SELECT * FROM user WHERE username = ?";
                        $stmtusernow = $db->prepare($sqlusernow);
                        $stmtusernow->execute([$_SESSION['username']]);
                        $rowusernow = $stmtusernow->fetch(PDO::FETCH_ASSOC);
        
                        $sqllike = "SELECT * FROM likepost WHERE id_user = {$rowusernow['id']} AND id_post = {$rowpost['id']}";
                        $resultlike = $db->query($sqllike);
                        $rowlike = $resultlike->fetch(PDO::FETCH_ASSOC);
        
                        if($rowlike) {?>
                            <a href="delete_like_post.php?id_post=<?= $rowpost['id'] ?>" class="d-inline text-body text-decoration-none" style="font-size: 25px;"><img src="img/heart_red.png" style="width: 15px;"/><?= $rowjumlahlike['jumlah'] ?></a>
                        <?php
                        } else if(!$rowlike) { ?>
                            <a href="create_like_post.php?id_post=<?= $rowpost['id'] ?>" class="d-inline text-body text-decoration-none" style="font-size: 25px;"><img src="img/heart.png" style="width: 15px;"/><?= $rowjumlahlike['jumlah'] ?></a>
                        <?php
                        }
                        ?>
                    <?php
                    } else { ?>
                        <a href="login.php" class="d-inline text-body text-decoration-none" style="font-size: 25px;"><img src="img/heart.png" style="width: 15px;"/><?= $rowjumlahlike['jumlah'] ?></a>
                    <?php
                    }
                    ?>
                <p class="d-inline">✉️<?=$rowjumlahcomment['jumlah'] ?></p>
                <a href="detail.php?id_post=<?= $rowpost['id'] ?>" class="text-body text-decoration-none">&nbsp; Detail</a>
            </div>
            
            <?php if(isset($_SESSION['user_role']) && !empty($_SESSION['user_role']) && $_SESSION['user_role'] == "admin") { ?>
            <div class="py-auto">
                <a href="delete_post.php?id_post=<?= $rowpost['id']?>" class="mt-5 text-body text-decoration-none" >Delete</a>
            </div>
            <?php } ?>
        </div>
        
        </div>
    </div>
    <?php
    }
    ?>
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
</body>
</html>