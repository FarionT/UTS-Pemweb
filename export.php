<?php
session_start();
require('db.php');
require_once __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Nama Lengkap');
$sheet->setCellValue('B1', 'Email');
$sheet->setCellValue('C1', 'Username');
$sheet->setCellValue('D1', 'Jumlah Like');
$sheet->setCellValue('E1', 'Jumlah Comment');
$sheet->setCellValue('F1', 'Konten Postingan');
$counter = 2;

$sqlpost = "SELECT id, konten, id_user FROM postingan";
$resultpost = $db->query($sqlpost);
while($rowpost = $resultpost->fetch(PDO::FETCH_ASSOC)) {
    $sqluser = "SELECT username,
    CASE
        WHEN namabelakang IS NULL THEN namadepan
        ELSE CONCAT(namadepan, ' ', namabelakang)
    END AS nama,
    email FROM user WHERE id = {$rowpost['id_user']}";
    $resultuser = $db->query($sqluser);
    $rowuser = $resultuser->fetch(PDO::FETCH_ASSOC);

    $sqllike = "SELECT COUNT(*) AS jumlahlike FROM likepost WHERE id_post = {$rowpost['id']}";
    $resultlike = $db->query($sqllike);
    $rowlike = $resultlike->fetch(PDO::FETCH_ASSOC);

    $sqlcomment = "SELECT COUNT(*) AS jumlahcomment FROM comment WHERE id_post = {$rowpost['id']}";
    $resultcomment = $db->query($sqlcomment);
    $rowcomment = $resultcomment->fetch(PDO::FETCH_ASSOC);

    $sheet->setCellValue('A'.$counter, $rowuser['nama']);
    $sheet->setCellValue('B'.$counter, $rowuser['email']);
    $sheet->setCellValue('C'.$counter, $rowuser['username']);
    $sheet->setCellValue('D'.$counter, $rowlike['jumlahlike']);
    $sheet->setCellValue('E'.$counter, $rowcomment['jumlahcomment']);
    $sheet->setCellValue('F'.$counter, $rowpost['konten']);
    $counter++;
}

$writer = new Xlsx($spreadsheet);
$writer->save('data_postingan.xlsx');

$filename = 'data_postingan.xlsx';

if(file_exists($filename)) {

    //Define header information
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Cache-Control: no-cache, must-revalidate");
    header("Expires: 0");
    header('Content-Disposition: attachment; filename="'.basename($filename).'"');
    header('Content-Length: ' . filesize($filename));
    header('Pragma: public');

    //Clear system output buffer
    flush();

    //Read the size of the file
    readfile($filename);
}

    header("Location: $_SERVER[HTTP_REFERER]");
?>