<?php
session_start();
require('db.php');

if(isset($_GET['id_user']) && !empty($_GET['id_user'])) {
    $id_user = $_GET['id_user'];
}
else if(isset($_POST['id_user']) && !empty($_POST['id_user'])) {
    $sqluser = "SELECT * FROM user WHERE id = {$_POST['id_user']}";
    $resultuser = $db->query($sqluser);
    $rowuser = $resultuser->fetch(PDO::FETCH_ASSOC);

    unlink($rowuser['profile']);

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
    header("Location: index.php");
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
    <?php require_once('navbar.php'); ?>
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
