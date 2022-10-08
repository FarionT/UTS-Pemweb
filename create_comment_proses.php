<?php
session_start();
require('db.php');

$sql1 = "SELECT * FROM user WHERE username = ?";

$stmt1 = $db->prepare($sql1);
$stmt1->execute([$_SESSION['username']]);
$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

$comment = $_POST['comment'];
date_default_timezone_set('Asia/Jakarta');
$tanggal = "20" . date('y-m-d');
$jam = date('h:i:s');
$id_post = $_POST['id_post'];
$id_user = $row1['id'];

$sql = "INSERT INTO comment (comment, tanggal, jam, id_post, id_user)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $db->prepare($sql);
$stmt->execute([$comment, $tanggal, $jam, $id_post, $id_user]);

header('location: detail.php?id_post=' . $id_post);