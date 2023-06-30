<?php

require_once 'functions.php';

$tanggal = date("d");
$bulan = date("m");
$tahun = date("Y");

function bulan($text)
{
    if ($text == "01") return "Januari";
    if ($text == "02") return "Februari";
    if ($text == "03") return "Maret";
    if ($text == "04") return "April";
    if ($text == "05") return "Mei";
    if ($text == "06") return "Juni";
    if ($text == "07") return "Juli";
    if ($text == "08") return "Agustus";
    if ($text == "09") return "September";
    if ($text == "10") return "Oktober";
    if ($text == "11") return "November";
    if ($text == "12") return "Desember";
}

require_once __DIR__ . '/vendor/autoload.php';

$nip = $_GET['nip'];

$uangGanti = showSingleTable("SELECT * FROM tb_uang_ganti WHERE nip = $nip AND status = 'acc'");

$userCuti = editData("SELECT * FROM user WHERE nip = $nip");
$pegawaiCuti = editData("SELECT * FROM pegawai WHERE nip = $nip");
$pengajuanCuti = editData("SELECT * FROM tb_cuti WHERE nip = $nip");

$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

$html = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak SK Cuti | ';

$html .= '' . $pegawaiCuti['nama'] . '; </title>

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
    <hr class="p-0">
    <p style="text-align:right">Banjarbaru,' . $tanggal . ' ' . bulan($bulan) . ' ' . $tahun . '</p>
    <h3 style="text-align:center; margin:0px; padding:0px;"><u>SURAT IZIN CUTI</u></h3>
    <p style="text-align:center; margin:0px; padding:0px;">NOMOR : 1A/C/2023/PN-BJB</p>

    <p style = "margin:0px; padding:0px; padding-top: 20px;">1. Diberikan cuti besar kepada Pegawai Negeri Sipil</p>

    <table style="width: 100%; margin-left: 16px;">
    <tr>
        <td style="width:29%;">Nama</td>
        <td style="width:2%;">:</td>';

$html .= '<td> ' . $userCuti['nama'] . ' </td>';

$html .= '</tr>
    <tr>
        <td>Nip</td>
        <td>:</td>';
$html .= '<td>' . $pegawaiCuti['nip'] . '</td>';

$html .= '</tr>
    <tr>
        <td>Pangkat</td>
        <td>:</td>';
$html .= '<td>' . $pegawaiCuti['golongan'] . '</td>';

$html .= '</tr>
    <tr>
        <td>Satuan Organisasi</td>
        <td>:</td>';
$html .= '<td> Pengadilan Negeri Banjarbaru </td></tr></table>';

$html .= '

    <p align="justify" style=" margin-bottom:10px;">Selama ' . $pengajuanCuti['hari'] . ' Hari, terhitung mulai ' . $pengajuanCuti['tanggal_cuti'] . ' sampai dengan tanggal ' . $pengajuanCuti['tanggal_kembali'] . ' dengan ketentuan sebagai berikut : </p>
    <p align="justify" style="padding:0px; margin-top:0px; margin-bottom:0px;">a. Sebelum menjalankan cuti besar wajib menyerahkan pekerjaanaya kepada atasan langsungnya</p>
    <p style="padding-left: 1em; padding-top:0px; margin-top:0px; margin-bottom:0px;">atau pejabat lain yang ditunjuk.</p>

    <p align="justify" style="padding:0px; margin-top:0px; margin-bottom:0px;">b. Selama menjalankan cuti besar, tidak berhak atas tunjangan jabatan.</p>

    <p align="justify" style="padding:0px; margin-top:0px; margin-bottom:0px;">c. Setelah selesai menjalankan cuti besar wajib melaporkan diri kepada atasanlangsungnya dan </p>
    <p style="padding-left: 1em; padding-top:0px; margin-top:0px; margin-bottom:0px;">bekerja kembali sebagaimana biasa.</p>

    <p style = "margin:0px; padding:0px; padding-top: 20px;">2. Demikianlah surat izin cuti besar ini dibuat untuk dapat digunakan sebagaimana mestinya.</p>

    </div>
    <br>
    <br><br>
    
    ';

$html .= '<p align="right" style="margin-right: 5px; margin-bottom: 0px; padding-bottom: 0px;">' . "Pengadilan Negeri Banjarbaru," . " " . $tanggal . " " . bulan($bulan) . " " . $tahun . '</p>';

$html .= '<p align="right" style="margin-right: 40px; margin-bottom: 0px; padding-bottom: 10px; padding-top: 0px; margin-top: 0px;">Ketua Pengadilan Negeri Banjarbaru</p>
<img style="margin-left: 450px; width: 150px;" src="dist/img/tanda_tangan.png">
<p align="right" style="margin-right: 45px; margin-bottom: 0px; padding-bottom: 0px; padding-top: 0px;"><b>BENNY SUDARSONO, SH., MH</b></p>
<p align="right" style="margin-right: 70px; margin-top: 0px; padding-top: 0px;"><b>19781214 200212 1 005</b></p>
</div>

<p style="padding:0px; margin-top:50px; margin-bottom:5px;"><b>TEMBUSAN</b></p>
<p style="padding:0px; margin-top:0px; margin-bottom:0px;">1. Yth. Walikota Banjarbaru;</p>
<p style="padding:0px; margin-top:0px; margin-bottom:0px;">2. Yth. Inspektur Inspektorat Daerah Kabupaten Banjarbaru;</p>
<p style="padding:0px; margin-top:0px; margin-bottom:0px;">3. Arsip;</p>

</body>';

$mpdf->WriteHTML($html);
$mpdf->Output();
