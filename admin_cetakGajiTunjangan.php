<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';
require_once 'functions.php';

require_once 'functions.php';

if (!isset($_SESSION['login'])) {
    header('Location:login.php');
} else {
    $nip = $_SESSION['nip'];
    $nama = $_SESSION['nama'];
    $password = $_SESSION['password'];
    $hakAses = $_SESSION['hak_akses'];
}

$nipGet = $_GET['nip'];
$verifikasiGajiTunjangan = $_GET['verifikasiGajiTunjangan'];

$cetakFilterGajiTunjangan = query("SELECT * FROM tb_tunjangan_dan_gaji_pegawai WHERE nip = '$nipGet' AND status = '$verifikasiGajiTunjangan'");

$a = editData("SELECT * FROM tb_tunjangan_dan_gaji_pegawai WHERE nip = '$nipGet'");

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
    <hr>
    <h4 style="text-align: center;">Rekapitulasi gaji dan tunjangan : <br> ' . $a['nip'] . ' - ' . $a['nama'] . '</h5>';

$html .= '<table style="width: 100%; border: 1px solid black;" cellspacing="0" cellpadding="5">
        <tr style="background-color: #BAD7E9;">
            <td style="border: 1px solid black;">No</td>
            <td style="border: 1px solid black;">Bulan</td>
            <td style="border: 1px solid black;">Gaji</td>
            <td style="border: 1px solid black;">Tunjangan</td>
            <td style="border: 1px solid black;">Total</td>
        </tr>';


$i = 1;
foreach ($cetakFilterGajiTunjangan as $row) :
    $html .= '<tr>';
    $html .= '<td style="border: 1px solid black;">' .  $i  . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['bulan']  . '</td>';
    $html .= '<td style="border: 1px solid black;">Rp. ' . number_format($row['gaji'], 0, ",", ".")  . ',-</td>';
    $html .= '<td style="border: 1px solid black;">Rp. ' . number_format($row['tunjangan'], 0, ",", ".")  . ',-</td>';
    $html .= '<td style="border: 1px solid black;">Rp. ' . number_format($row['total_gaji'], 0, ",", ".")  . ',-</td>';
    $html .= '</tr>';
    $i++;
endforeach;

$html .= '</table>';

$mpdf->WriteHTML($html);
$mpdf->Output();
