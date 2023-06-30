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
$pengajuanUangGanti = editData("SELECT * FROM pegawai WHERE nip = $nip");

$status = $_GET['status'];

$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

$html = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Pencairan Uang | ';

$html .= '' . $pengajuanUangGanti['nama'] . '; </title>

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
    <h3 style="text-align:center">RINCIAN DAN SURAT PENCAIRAN PENGAJUAN PENGGANTIAN UANG</h3>

    <table style="width: 100%; border: 1px solid black;" cellspacing="0" cellpadding="5">
        <tr style="background-color: #BAD7E9;">
            <td style="border: 1px solid black;">No</td>
            <td style="border: 1px solid black;">Nama</td>
            <td style="border: 1px solid black;">Nip</td>
            <td style="border: 1px solid black;">Tanggal transaksi</td>
            <td style="border: 1px solid black;">Nominal</td>
            <td style="border: 1px solid black;">Status</td>
        </tr>';

$i = 1;
foreach ($uangGanti as $row) :
    $html .= '<tr>';
    $html .= '<td style="border: 1px solid black;">' .  $i  . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['nama']  . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['nip']  . '</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['tanggal_transaksi']  . '</td>';
    $html .= '<td style="border: 1px solid black;">Rp. ' .  $row['nominal']  . ',-</td>';
    $html .= '<td style="border: 1px solid black;">' .  $row['status']  . '</td>';
    $html .= '</tr>';
    $i++;
endforeach;

$html .= '</table>

    <h3 style = "text-align: center;">DENGAN TOTAL</h3>';

$total = 0;
foreach ($uangGanti as $row) :
    $total += $row['nominal'];
endforeach;

$html .= ' <h3 style = "text-align: center; margin: 0px; padding: 0px;">Rp. ' . $total . ',-</h3>

    <p align="justify" style="padding-left:3em; margin-bottom:0px; margin-left: 10px;">Pada dasarnya surat ini dibuat dengan berdasarkan data yang di dapat dari persetujuan </p>
    <p align="justify" style="padding:0px; margin-top:0px;">admin dan ketua pengadilan dengan sebenar benarnya data. Demikian kami sampaikan sebagaimana mestinya, tunjukkan ini kepada loket bagian keuangan sebagai bukti sah penggantian uang pribadi yang sebelumnya digunakan.</p>
    </div>
    <br>
    <br>
    <br>
    <br>';

$html .= '<p align="right" style="margin-right: 5px; margin-bottom: 0px; padding-bottom: 0px;">' . "Pengadilan Negeri Banjarbaru," . " " . $tanggal . " " . bulan($bulan) . " " . $tahun . '</p>';

$html .= '<p align="right" style="margin-right: 40px; margin-bottom: 0px; padding-bottom: 10px; padding-top: 0px; margin-top: 0px;">Ketua Pengadilan Negeri Banjarbaru</p>
<img style="margin-left: 450px; width: 150px;" src="dist/img/tanda_tangan.png">
<p align="right" style="margin-right: 45px; margin-bottom: 0px; padding-bottom: 0px; padding-top: 0px;"><b>BENNY SUDARSONO, SH., MH</b></p>
<p align="right" style="margin-right: 70px; margin-top: 0px; padding-top: 0px;"><b>19781214 200212 1 005</b></p>
</div>
</body>';

$mpdf->WriteHTML($html);
$mpdf->Output();

if (hapusUangGantiAcc($status) > 0) {
    echo "
    <script>
    document.location.href = 'uangGanti.php';
    </script>
    ";
} else {
    mysqli_error($conn);
}
