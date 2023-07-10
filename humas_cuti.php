<?php
session_start();

require_once 'functions.php';
require_once 'templates/header.php';

$cutiHumas = query("SELECT * FROM tb_cuti");

if (isset($_POST['verifikasi'])) {
    if (verifikasiPengajuanCuti($_POST) > 0) {
        echo "<script>
        alert('berhasil diverifikasi');
        document.location.href = 'humas_cuti.php';
        </script>";
    }
}

$tahunSekarang = date('Y');


if (isset($_GET['tahun']) && isset($_GET['status'])) {
    $tahun = $_GET['tahun'];
    $status = $_GET['status'];

    $cuti = query("SELECT * FROM tb_cuti WHERE YEAR(tanggal_cuti) = '$tahun' AND status = '$status'");
} else {
    $cuti = query("SELECT * FROM tb_cuti WHERE YEAR(tanggal_cuti) = '$tahunSekarang' AND status = 'acc humas'");
}

$cutiData = [];  // Inisialisasi array untuk menyimpan data bulanan

// Inisialisasi array data dengan nilai awal 0 untuk setiap bulan
for ($i = 0; $i < 12; $i++) {
    $cutiData[$i] = 0;
}

// Loop melalui data absensi yang didapatkan dan hitung jumlah kejadian untuk setiap bulan
foreach ($cuti as $data) {
    $bulan = date('n', strtotime($data['tanggal_cuti']));  // Ambil bulan dari tanggal
    $cutiData[$bulan - 1]++;  // Tambahkan jumlah untuk bulan yang sesuai
}

// Konversi array absensiData menjadi string yang dipisahkan oleh koma
$cutiDataString = implode(', ', $cutiData);


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
                            <h1 class="m-0">Laporan pengajuan cuti</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Laporan pengajuan cuti</a></li>
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
                            <a href="humas_cetakCuti.php?tahun=<?= $_GET['tahun']; ?>&status=<?= $_GET['status']; ?>" class="btn btn-success btn-sm" target="_blank">Cetak berdasarkan pencarian</a>
                        <?php else : ?>
                            <a href="humas_cetakCutiAll.php" class="btn btn-success btn-sm" target="_blank">Cetak semua data</a>
                        <?php endif; ?>
                    </div>

                    <div class="card">
                        <div class="card-header mb-0">
                            <img src="dist/img/cutiadmin.jpg" alt="" style="width: 210px;" class="float-right pl-3">
                            <h4>Laporan cuti pegawai pengadilan negeri banjarbaru</h4>

                            <?php
                            $tanggalCuti = date('m');
                            $hitungCuti = hitungBaris("SELECT * FROM tb_cuti WHERE MONTH(tanggal_cuti) = '$tanggalCuti' AND status = 'acc humas'");

                            ?>
                            <h3 style="color: green;"><?= $hitungCuti; ?>Data</h3>
                            <p style="margin: 0px; padding: 0px;"><b><em>Total pegawai yang cuti bulan ini</em></b></p>
                            <br>

                            <form action="humas_cuti.php" method="get">

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

                        <div class="container col-lg-12 p-3">
                            <table id="testing" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Nip</th>
                                        <th>Tanggal Cuti</th>
                                        <th>Hari</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Surat Pengajuan</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Nip</th>
                                        <th>Tanggal Cuti</th>
                                        <th>Hari</th>
                                        <th>Tanggal Kembali</th>
                                        <th>Surat Pengajuan</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($cutiHumas as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['nip']; ?></td>
                                            <td><?= $row['tanggal_cuti']; ?></td>
                                            <td><?= $row['hari']; ?></td>
                                            <td><?= $row['tanggal_kembali']; ?></td>

                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#surat_pengajuan<?= $row['id']; ?>">
                                                    <i class="far fa-eye"></i> Lihat
                                                </button>

                                                <!-- Modal -->
                                                <div class="modal fade" id="surat_pengajuan<?= $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Surat pengajuan, <?= $row['nip']; ?></h5>
                                                            </div>
                                                            <div class="modal-body modal-xl" id="modal-body">
                                                                <div>
                                                                    <iframe src="dist/pdf/<?= $row['surat_pengajuan']; ?>" frameborder="0" width="470" height="520"></iframe>
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
                                                    <p class="badge badge-success" target="_blank">[Acc humas]</p>
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
                                                                        <select class="form-control verifikasiPengajuan" aria-label="Default select example" name="verifikasiCuti">
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
</script>

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
                            echo $tahunSekarang . ' - acc humas';
                        }
                        ?>',
                data: [<?= $cutiDataString; ?>],
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