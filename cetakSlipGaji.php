<?php
session_start();
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
$id = $_GET['id'];

$slipUser = editData("SELECT * FROM tb_tunjangan_dan_gaji_pegawai WHERE nip = '$nip' AND id = '$id'");

$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);

$html = '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak verified reimbursment </title>

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
                    <p style="font-size: 20px;">SLIP GAJI DAN TUNJANGAN PEGAWAI</p>
                    <P style="font-size: 20px;">PENGADILAN NEGERI BANJARBARU</P>
                    <P style="font-size: 12px";>Jl. Trikora No.3, Guntung Paikat, Kec. Banjarbaru Selatan, Kota Banjar Baru, Kalimantan Selatan</P>
                    <p style="font-size: 12px";>Email: pn.banjarbarukalsel@gmail.com Kode Pos: 70714</p>
                </center>
            </td>
            <td style="width:15%;">
            <img src="dist/img/logo.jpg" alt="" style="width:80px; height: 100px;">
            </td>
        </tr>
    </table>
    <hr class="p-0">
    <h3 style="text-align: center;">SLIP GAJI DAN TUNJANGAN</h3>

    <p>Kode Gaji : ' . $slipUser['id_gaji'] . '</p>

    <style type="text/css">
        .tg  {border-collapse:collapse;border-spacing:0;}
        .tg td{border-width:1px;font-family:Arial, sans-serif;font-size:14px;
        overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg th{border-width:1px;font-family:Arial, sans-serif;font-size:14px;
        font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
        .tg .tg-0lax{text-align:left;vertical-align:top}
    </style>';

$html .= '<table class="tg">
    <thead>
        <tr>
            <th style="width: 25%;" class="tg-0lax">Bulan </th>
            <th class="tg-0lax">: ' . $slipUser['bulan'] . '</th>
        </tr>
        <tr>
            <th style="width: 25%;" class="tg-0lax">Diterima oleh </th>
            <th class="tg-0lax">: ' .  $slipUser['nama'] . ' </th>
        </tr>
        <tr>
            <th style="width: 25%;" class="tg-0lax">Nip </th>
            <th class="tg-0lax">: ' . $slipUser['nip'] . ' </th>
        </tr>
        <tr>
            <th><hr></th>
            <th><hr></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="tg-0lax">Total Hadir</td>
            <td class="tg-0lax">: ' . $slipUser['jumlah_hadir'] . ' Hari</td>
        </tr>
        <tr>
            <td class="tg-0lax">Total Terlambat</td>
            <td class="tg-0lax">: ' . $slipUser['jumlah_terlambat'] . ' Hari</td>
        </tr>
        <tr>
            <td class="tg-0lax">Total Tanpa Keterangan</td>
            <td class="tg-0lax">: ' . $slipUser['jumlah_tanpa_keterangan'] . ' Hari</td>
        </tr>
        <tr>
            <th><hr></th>
            <th><hr></th>
        <tr>
            <td class="tg-0lax">Gaji</td>
            <td class="tg-0lax">: Rp. ' . number_format($slipUser['gaji'], 0, ",", ".") . ',-</td>
        </tr>
        <tr>
            <td class="tg-0lax">Tunjangan</td>
            <td class="tg-0lax">: Rp. ' . number_format($slipUser['tunjangan'], 0, ",", ".") . ',-</td>
        </tr>
        <tr>
            <td class="tg-0lax">Total</td>
            <td class="tg-0lax">: Rp. ' . number_format($slipUser['total_gaji'], 0, ",", ".") . ',-</td>
        </tr>
        <tr>
            <td class="tg-0lax"></td>
            <td class="tg-0lax"></td>
        </tr>
        <tr>
            <td class="tg-0lax">Verifikasi</td>
            <td class="tg-0lax">: Admin dan Humas</td>
        </tr>
    </tbody>
    </table>';

$html .= '<hr class="p-0">

    <br>

    <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }
    td {
      text-align: center;
      padding: 10px;
    }
    td img {
      display: block;
      width: 100px;
      height: auto;
      margin-bottom: 10px;
    }
    td p {
      margin: 0;
      font-weight: bold;
    }
    td span {
      display: block;
      font-style: italic;
    }
  </style>


  <table>
    <tr>
      <td>
        <p>SIM Cuti PN</p>
        <p>Mengetahui,</p>
        <p>Admin</p>
        <br>
        <img style="width: 30%;" src="dist/img/ttd_1.jpg" alt="Admin Signature">
        <p>Budi Harsono</p>
        <p>NIP. 192873 820 2374</p>
      </td>
      <td>
        <p>Banjarbaru, ' . date('d F Y') . '.</p>
        <p>Bertanggung Jawab,</p>
        <p>Humas</p>
        <br>
        <img style="width: 30%;" src="dist/img/ttd_3.jpg" alt="Humas Signature">
        <p>Ilham muhaimin akbar</p>
        <p>NIP. 1928374 2374 28872</p>
      </td>
    </tr>
  </table>

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
