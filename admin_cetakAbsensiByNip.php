<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once 'functions.php';

// $bulan = $_GET['bulan'];
// $tahun = $_GET['tahun'];

session_start();

require_once 'functions.php';

// $tanggal = $_GET['tanggal_absen'];

if (!isset($_SESSION['login'])) {
    header('Location:login.php');
} else {
    $nip = $_SESSION['nip'];
    $nama = $_SESSION['nama'];
    $password = $_SESSION['password'];
    $hakAses = $_SESSION['hak_akses'];
}

$nipModal = $_GET['nip'];

$dariTanggal = $_GET['dari'];
$sampaiTanggal = $_GET['sampai'];

$cetakFilterPresensiByTahunAndBulan = editData("SELECT * FROM tb_absensi WHERE nip = '$nipModal'");

$cetakFilterPresensiByNip = query("SELECT * FROM tb_absensi WHERE nip = '$nipModal'");




// $cetakFilterPresensiByTahunAndBulan2 = query("SELECT * FROM " . 'tb_absensi' . " WHERE " . "MONTH (tanggal_absen) = " . "'$bulan'" . ' AND ' . "YEAR (tanggal_absen) = " . "'$tahun'" . ' AND ' . "nip = " . "'$nip'");

// $a = "SELECT * FROM " . 'tb_absensi' . " WHERE " . "MONTH (tanggal_absensi) = " . "'$bulan'" . ' AND ' . "YEAR (tanggal_absensi) = " . "'$tahun'" . ' AND ' . "nip = " . "'$nip'";

// print_r($cetakFilterPresensiByTahunAndBulan2);
// die;

// echo $cetakFilterPresensiByTahunAndBulan['nip'];
// die;

// $a = "SELECT * FROM " . 'tb_absensi' . " WHERE " . "tanggal_absen >= " . "'$dariTanggal'" . ' AND ' . "tanggal_absen <= " . "'$sampaiTanggal'" . ' AND ' . " nip = " . "'333'";

// print_r($cetakFilterPresensiByTahunAndBulan);
// die;

// ($cetakFilterPresensiByTahunAndBulan);
// die;

$mpdf = new \Mpdf\Mpdf();


$html = '<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rekap Absensi ';

$html .= '</title>

    <link rel="icon" href="img/icon.ico">
    <link rel="stylesheet" href="css/print.css">
</head>

<body>
  <div class="container-fluid";>
    <table style="border: 1px solid #fff; width: 100%;">
        <tr>
            <td style="width: 15%;">
                <img src="dist/img/banjarbaru.png" style="width:80px; height:100px;">
            </td>
            <td style="width:70%;">
                <center>
                    <p style="font-size: 20px;">PENGADILAN NEGERI</p>
                    <P style="font-size: 20px;">BANJARBARU</P>
                    <P style="font-size: 12px";>Jl. Trikora No.3, Guntung Paikat, Kec. Banjarbaru Selatan, Kota Banjar Baru, Kalimantan Selatan</P>
                    <p style="font-size: 12px";>Email: pn.banjarbarukalsel@gmail.com Kode Pos: 70714</p>
                </center>
            </td>
            <td style="width:15%;">
            <img src="dist/img/logo.png" alt="" style="width:80px; height: 100px;">
            </td>
        </tr>
    </table>
    <hr>
    <h3 style="text-align: center;">REKAPITULASI PRESENSI : ' . $cetakFilterPresensiByTahunAndBulan['nama'] . '</h3>';

$html .= '<table style="width: 100%; border: 1px solid black;" cellspacing="0" cellpadding="5">
        <tr style="background-color: #BAD7E9;">
            <td style="border: 1px solid black;">No</td>
            <td style="border: 1px solid black;">Nama</td>
            <td style="border: 1px solid black;">Nip</td>
            <td style="border: 1px solid black;">Tanggal absen</td>
            <td style="border: 1px solid black;">Jam masuk</td>
            <td style="border: 1px solid black;">Jam pulang</td>
            <td style="border: 1px solid black;">Catatan</td>
        </tr>';


$i = 1;
foreach ($cetakFilterPresensiByNip as $row) :
    $html .= '<tr>';
    $html .= '<td style="border: 1px solid black;">' .  $i  . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['nama']  . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['nip']  . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['tanggal_absen']  . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['jam_masuk']  . ' WITA</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['jam_pulang']  . ' WITA</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['catatan']  . '</td>';
    $html .= '</tr>';
    $i++;
endforeach;

$html .= '</table>';

$mpdf->WriteHTML($html);
$mpdf->Output();
