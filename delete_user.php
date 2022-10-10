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
    <div class="container">
        <div class="my-5 p-5" style=" height:200px;background-image:url('img/bg_profile.png');border-radius:20px;">
            <?php
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
            ?>
            <img src=<?= $row['profile'] ?> class="d-inline-block my-auto" style="width:10%" />

            <div class="d-inline-block">
                <?php
                    if($row['namabelakang'] == NULL) {?>
                        <h4><?= $row['namadepan'] ?></h4>
                        <?php
                    } else { ?>
                        <h4><?= $row['namadepan'] . ' ' . $row['namabelakang']?></h4>    
                    <?php
                    }
                    ?>
                    <p><?= $row['pekerjaan'] ?></p>
            </div>
        </div>
        <div class="container text-center bg-white col-6 my-5 p-2">
            <h3>Are you sure to delete this user?</h3>  
            <div class="">
                <form action="delete_user.php" method="post" class="d-inline-block">
                    <input hidden name="id_user" value='<?= $row['id']?>' />
                    <button class="btn btn-primary">Yes</button>
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
</body>
</html>
