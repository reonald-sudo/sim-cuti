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

$nipModal = $_GET['nip'];

$dariTanggal = $_GET['dari'];
$sampaiTanggal = $_GET['sampai'];

$cetakFilterPresensiByTahunAndBulan = editData("SELECT * FROM tb_uang_ganti WHERE nip = '$nipModal' ORDER BY tanggal_transaksi DESC");

$cetakFilterPengajuanByNip = query("SELECT * FROM tb_uang_ganti WHERE nip = '$nipModal' ORDER BY tanggal_transaksi DESC ");




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
    <title>Cetak Rekap Reamburstment ';

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
    <h4 style="text-align: center;">Rekapitulasi pengajuan reimbursment <br> ' . $cetakFilterPresensiByTahunAndBulan['nama'] . ' - ' . $cetakFilterPresensiByTahunAndBulan['nip'] . '</h5>';

$html .= '<table style="width: 100%; border: 1px solid black;" cellspacing="0" cellpadding="5">
        <tr style="background-color: #BAD7E9;">
            <td style="border: 1px solid black;">No</td>
            <td style="border: 1px solid black;">Nama & Nip</td>
            <td style="border: 1px solid black;">Tanggal transaksi</td>
            <td style="border: 1px solid black;">Nominal</td>
            <td style="border: 1px solid black;">Status</td>
        </tr>';


$i = 1;
foreach ($cetakFilterPengajuanByNip as $row) :
    $html .= '<tr>';
    $html .= '<td style="border: 1px solid black;">' .  $i  . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['nip']  . ' <br> ' . $row['nama'] . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  date('d-m-Y', strtotime($row['tanggal_transaksi']))  . '</td>';
    $html .= '<td style="border: 1px solid black;">Rp. ' . number_format($row['nominal'], 0, ",", ".")  . ',-</td>';
    $html .= '<td style="border: 1px solid black;">' . $row['status'] . '</td>';
    $html .= '</tr>';
    $i++;
endforeach;

$html .= '</table>';

$mpdf->WriteHTML($html);
$mpdf->Output();
