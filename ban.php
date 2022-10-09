<?php
session_start();
require('db.php');

$id_user = $_GET['id_user'];
$sql = "UPDATE user
        SET role = 'ban'
        WHERE id = {$id_user}";
$db->query($sql);

header("Location: $_SERVER[HTTP_REFERER]");
?>