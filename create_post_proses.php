<?php
session_start();
require('db.php');

$sql1 = "SELECT * FROM user WHERE username = ?";

$stmt1 = $db->prepare($sql1);
$stmt1->execute([$_SESSION['username']]);
$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

$id_user = $row1['id'];
$subject = $_POST['subject'];
$konten = $_POST['konten'];
$kategori = $_POST['kategori'];
date_default_timezone_set('Asia/Jakarta');
$tanggal = "20" . date('y-m-d');
$jam = date('h:i:s');

$sql = "INSERT INTO postingan (subject, konten, kategori, tanggal, jam, id_user)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $db->prepare($sql);
$stmt->execute([$subject, $konten, $kategori, $tanggal, $jam, $id_user]);

header('location: dashboard.php');