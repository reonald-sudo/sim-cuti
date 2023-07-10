<?php

session_start();

require_once 'functions.php';
require_once 'templates/header.php';

$uangGantiHumas = query("SELECT * FROM tb_uang_ganti");

if (isset($_POST['verifikasi'])) {
    if (verifikasiPengajuan($_POST) > 0) {
        echo "<script>
        alert('berhasil diverifikasi');
        document.location.href = 'humas_uangGanti.php';
        </script>";
    }
}

$tahunSekarang = date('Y');

if (isset($_GET['tahun']) && isset($_GET['status'])) {
    $tahun = $_GET['tahun'];
    $status = $_GET['status'];

    $reimburstment = query("SELECT SUM(nominal) AS total_nominal, MONTH(tanggal_transaksi) AS bulan FROM tb_uang_ganti WHERE YEAR(tanggal_transaksi) = '$tahun' AND status = '$status' GROUP BY bulan");
} else {
    $reimburstment = query("SELECT SUM(nominal) AS total_nominal, MONTH(tanggal_transaksi) AS bulan FROM tb_uang_ganti WHERE YEAR(tanggal_transaksi) = '$tahunSekarang' AND status = 'acc humas' GROUP BY bulan");
}

$reimburstmentData = [];  // Inisialisasi array untuk menyimpan data bulanan
$totalNominal = 0;  // Inisialisasi variabel total nominal

// Inisialisasi array data dengan nilai awal 0 untuk setiap bulan
for ($i = 0; $i < 12; $i++) {
    $reimburstmentData[$i] = 0;
}

// Loop melalui data reimbursement yang didapatkan dan hitung total nominal untuk setiap bulan
foreach ($reimburstment as $data) {
    $bulan = $data['bulan'];  // Ambil bulan dari hasil query
    $reimburstmentData[$bulan - 1] = $data['total_nominal'];  // Simpan total nominal untuk bulan yang sesuai
    $totalNominal += $data['total_nominal'];  // Tambahkan total nominal
}

// Format total nominal dengan Rp. dan pemisah ribuan dan desimal
$totalNominalFormatted = 'Rp. ' . number_format($totalNominal, 0, ',', '.');

// Konversi array reimbursementData menjadi string yang dipisahkan oleh koma
$reimburstmentDataString = implode(', ', $reimburstmentData);

?>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <!-- navbar and sidebar -->
        <?php require_once 'templates/navbar.php' ?>
        <?php require_once 'templates/sidebar.php' ?>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Laporan pengajuan uang ganti</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Data Pengajuan Uang Ganti</a></li>
                                <li class="breadcrumb-item active">Humas</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="mb-2">
                        <?php if (isset($_GET['tahun']) && isset($_GET['status'])) : ?>
                            <a href="humas_cetakUangGanti.php?tahun=<?= $_GET['tahun']; ?>&status=<?= $_GET['status']; ?>" class="btn btn-success btn-sm" target="_blank">Cetak berdasarkan pencarian</a>
                        <?php else : ?>
                            <a href="humas_cetakUangGantiAll.php" class="btn btn-success btn-sm" target="_blank">Cetak semua data</a>
                        <?php endif; ?>
                    </div>

                    <div class="card">
                        <div class="card-header mb-0">
                            <img src="dist/img/duitadmin.jpg" alt="" style="width: 250px;" class="float-right pl-3">

                            <?php
                            $bulanNow =  date('m');
                            $tahunNow =  date('Y');
                            ?>

                            <p style="margin: 0px; padding: 0px;"><b>Total reimbursement bulan <?= date('F') ?> - <?= $tahunNow ?></b></p>

                            <?php
                            $uangGanti = showSingleTable("SELECT * FROM tb_uang_ganti WHERE MONTH(tanggal_transaksi) = '$bulanNow' AND YEAR (tanggal_transaksi) = '$tahunNow' ");
                            $totalUangGanti = 0;

                            foreach ($uangGanti as $row) {
                                $totalUangGanti += $row['nominal'];
                            }
                            ?>

                            <h3 style="color: green;">Rp. <?= number_format($totalUangGanti, 0, ",", "."); ?></h3>
                            <p><em>Ini merupakan total dari seluruh pengajuan reimbursement, bulan <?= date('F'); ?> tahun <?= $tahunNow; ?>.</em></p>

                            <form action="humas_uangGanti.php" method="get">

                                <div class="row">
                                    <div class="mr-2">
                                        <!-- TAHUN -->
                                        <select class="form-select form-control" name="tahun">
                                            <option selected>Tahun</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                        </select>
                                    </div>

                                    <div class="mr-2">
                                        <!-- STATUS -->
                                        <select class="form-select form-control" name="status">
                                            <option selected>Status</option>
                                            <option value="acc humas">acc humas</option>
                                            <option value="ditolak">ditolak</option>
                                        </select>
                                    </div>

                                    <button class="submit btn-primary btn" type="submit">Cari</button>
                                </div>

                            </form>

                        </div>

                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                        <hr>

                        <div class="container mb-3 p-3">
                            <table id="testing" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Nip</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Nominal</th>
                                        <th>Nota</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Nip</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Nominal</th>
                                        <th>Nota</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php $total = 0 ?>
                                    <?php foreach ($uangGantiHumas as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['nip']; ?></td>
                                            <td><?= $row['tanggal_transaksi']; ?></td>
                                            <td>Rp. <?= number_format($row['nominal'], 0, ",", "."); ?></td>

                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#nota<?= $row['id']; ?>">
                                                    <i class="far fa-eye"></i> Lihat
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="nota<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Nota <?= $row['tanggal_transaksi']; ?></h5>
                                                            </div>
                                                            <div class="modal-body modal-xl" id="modal-body">
                                                                <div>
                                                                    <img src="dist/img/<?= $row['nota']; ?>" alt="" srcset="" width="100%">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <?php if ($row['status'] === 'acc admin') : ?>
                                                    <p class="badge badge-success"><?= $row['status']; ?></p>
                                                <?php elseif ($row['status'] === 'sedang proses') : ?>
                                                    <p class="badge badge-warning"><?= $row['status']; ?></p>
                                                <?php elseif ($row['status'] === 'acc humas') : ?>
                                                    <p class="badge badge-success">[Acc humas]</p>
                                                <?php else : ?>
                                                    <p class="badge badge-danger"><?= $row['status'] . ' - ' . $row['alasan']; ?></p>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#verifikasi<?= $row['id']; ?>">
                                                    Verifikasi
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="verifikasi<?= $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <form action="" method="post">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Verifikasi pengajuan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">

                                                                    <div class="form-group">
                                                                        <select class="form-control verifikasiPengajuan" aria-label="Default select example" name="verifikasiPengajuan">
                                                                            <option selected>Verifikasi pengajuan</option>
                                                                            <option value="acc humas">Acc</option>
                                                                            <option value="ditolak">Ditolak</option>
                                                                        </select>

                                                                        <input type="text" name="statusDitolak" id="alasanDitolak" class="form-control mt-3 alasanDitolak" placeholder="Alasan ditolak" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="verifikasi">Save changes</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>


                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>

                    </div>
                    <br>




                </div>
            </section>
        </div>

        <!-- Footer -->
        <?php require_once 'templates/footer.php' ?>

        </aside>
    </div>

    <?php require_once 'templates/script.php' ?>
</body>

<script src="js/script.js"></script>

<script>
    $(function() {
        $('#testing').DataTable()
    });

    $(".verifikasiPengajuan").change(function() {
        var alasanDitolak = $(this).closest('.form-group').find('.alasanDitolak');
        if ($(this).val() == "ditolak") {
            alasanDitolak.removeAttr("readonly");
        } else {
            alasanDitolak.attr("readonly", "readonly");
        }
    });
</script>

<script>
    const ctx = document.getElementById('myChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: '<?php
                        if (isset($_GET['tahun']) && isset($_GET['status'])) {
                            echo $tahun . ' - ' . $status;
                        } else {
                            echo $tahunSekarang . ' - Acc humas';
                        }
                        ?>',
                data: [<?= $reimburstmentDataString ?>],
                borderWidth: 0,
                pointRadius: 4,
                backgroundColor: 'transparent',
                borderColor: 'rgb(75, 192, 192)',
                pointBackgroundColor: 'black',
                pointBorderColor: 'black',
                pointHoverRadius: 6
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>











</html>