<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once 'functions.php';

// $bulan = $_GET['bulan'];
// $tahun = $_GET['tahun'];

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

// $nipModal = $_GET['nip'];

$nipInput = isset($_GET['nip']) ? $_GET['nip'] : '';
$dariTanggal = $_GET['dari'];
$sampaiTanggal = $_GET['sampai'];

if (empty($nipInput)) {
    $cetakFilterPresensiByTahunAndBulan = query("SELECT * FROM " . 'tb_absensi' . " WHERE " . "tanggal_absen >= " . "'$dariTanggal'" . ' AND ' . "tanggal_absen <= " . "'$sampaiTanggal'" . ' ORDER BY tanggal_absen DESC ' . "");
} else {
    $cetakFilterPresensiByTahunAndBulan = query("SELECT * FROM " . 'tb_absensi' . " WHERE " . "tanggal_absen >= " . "'$dariTanggal'" . ' AND ' . "tanggal_absen <= " . "'$sampaiTanggal'" . ' AND ' . "nip = " . "'$nipInput'" . ' ORDER BY tanggal_absen DESC ' . "");
}

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
                <img src="dist/img/banjarbaru.jpg" style="width:80px; height:100px;">
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
            <img src="dist/img/logo.jpg" alt="" style="width:80px; height: 100px;">
            </td>
        </tr>
    </table>
    <hr>';

foreach ($cetakFilterPresensiByTahunAndBulan as $row) :
endforeach;

if (empty($nipInput)) {
    $html .= '<h3 style="text-align: center;">Rekapitulasi presensi dari : ' . $dariTanggal . ' sampai ' . $sampaiTanggal . '</h3>';
} else {
    $html .= '<h3 style="text-align: center;">Rekapitulasi presensi ' . $row['nip'] . ' - ' . $row['nama'] . '. <br> dari : ' . $dariTanggal . ' sampai ' . $sampaiTanggal . '</h3>';
}

$html .= '<table style="width: 100%; border: 1px solid black;" cellspacing="0" cellpadding="5">
        <tr style="background-color: #BAD7E9;">
            <td style="border: 1px solid black;">No</td>
            <td style="border: 1px solid black; width: 40%">Nip & Nama</td>
            <td style="border: 1px solid black;">Tanggal</td>
            <td style="border: 1px solid black;">Jam masuk</td>
            <td style="border: 1px solid black;">Jam pulang</td>
            <td style="border: 1px solid black;">Catatan</td>
        </tr>';


$i = 1;
foreach ($cetakFilterPresensiByTahunAndBulan as $row) :
    $html .= '<tr>';
    $html .= '<td style="border: 1px solid black;">' .  $i  . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['nip']  . ' <br> ' .  $row['nama']  . ' </td>';
    $html .= '<td style="border: 1px solid black;">' .  date('d-m-Y', strtotime($row['tanggal_absen']))  . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['jam_masuk']  . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['jam_pulang']  . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['catatan']  . '</td>';
    $html .= '</tr>';
    $i++;
endforeach;

$html .= '</table>';

$mpdf->WriteHTML($html);
$mpdf->Output();
