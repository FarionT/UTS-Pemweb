<?php
session_start();
require('db.php');

$sqluser = "SELECT * FROM user WHERE username = ?";
$stmtuser = $db->prepare($sqluser);
$stmtuser->execute([$_SESSION['username']]);
$rowuser = $stmtuser->fetch(PDO::FETCH_ASSOC);

$id_post = $_GET['id_post'];
$id_user = $rowuser['id'];

$sql = "DELETE FROM likepost
        WHERE id_post = ? AND id_user = ?";
$stmt = $db->prepare($sql);
$stmt->execute([$id_post, $id_user]);

header("Location: $_SERVER[HTTP_REFERER]");
?>