<?php
session_start();

require_once 'functions.php';
require_once 'templates/header.php';

$tahunSekarang = date('Y');


if (isset($_GET['tahun']) && isset($_GET['status'])) {
    $tahun = $_GET['tahun'];
    $status = $_GET['status'];

    $absensi = query("SELECT * FROM tb_absensi WHERE YEAR(tanggal_absen) = '$tahun' AND catatan = '$status' ORDER BY tanggal_absen DESC ");
} else {
    $absensi = query("SELECT * FROM tb_absensi ORDER BY tanggal_absen DESC ");
}

$absensiData = [];  // Inisialisasi array untuk menyimpan data bulanan

// Inisialisasi array data dengan nilai awal 0 untuk setiap bulan
for ($i = 0; $i < 12; $i++) {
    $absensiData[$i] = 0;
}

// Loop melalui data absensi yang didapatkan dan hitung jumlah kejadian untuk setiap bulan
foreach ($absensi as $data) {
    $bulan = date('n', strtotime($data['tanggal_absen']));  // Ambil bulan dari tanggal
    $absensiData[$bulan - 1]++;  // Tambahkan jumlah untuk bulan yang sesuai
}

// Konversi array absensiData menjadi string yang dipisahkan oleh koma
$absensiDataString = implode(', ', $absensiData);

$pegawai = query("SELECT * FROM pegawai");


?>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <!-- navbar and sidebar -->
        <?php require_once 'templates/navbar.php' ?>
        <?php require_once 'templates/sidebar.php' ?>

        <!-- Header 🗣 -->
        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Presensi pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="humas_laporanPresensi.php">Presensi pegawai</a></li>
                                <li class="breadcrumb-item active">Humas</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <!-- \\Content Area 😗 -->

            <section class="content">
                <div class="container-fluid">

                    <div class="card">

                        <!-- header card -->
                        <div class="ml-3">
                            <img src="dist/img/humas_absensi.jpg" alt="" style="width: 180px;" class="float-right pl-3 mr-2">

                            <h5 class="mt-3"><strong>Laporan presensi pegawai pengadilan negeri banjarbaru</strong></h5>
                            <p><em>Data presensi para pegawai pengadilan negeri banjarbaru, pada aplikasi SIM Cuti yang tersaji dalam diagram.</em></p>

                            <div class="row ml-2">

                                <form action="humas_laporanPresensi.php" method="get">

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
                                                <option value="hadir">Hadir</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="tanpa keterangan">Tanpa keterangan</option>
                                                <option value="terlambat">Terlambat</option>
                                            </select>
                                        </div>

                                        <button class="submit btn-primary btn" type="submit">Cari</button>

                                    </div>

                                </form>

                            </div>

                            <div class="mb-2">
                                <?php if (isset($_GET['tahun']) && isset($_GET['status'])) : ?>
                                    <a href="humas_cetakPresensi.php?tahun=<?= $_GET['tahun']; ?>&status=<?= $_GET['status']; ?>" class="btn btn-success btn-sm mr-1" target="_blank">Cetak berdasarkan pencarian</a>
                                <?php else : ?>
                                    <a href="humas_cetakPresensiAll.php" class="btn btn-success btn-sm mr-1" target="_blank">Cetak semua data</a>
                                <?php endif; ?>

                                <button type="button" class="btn btn-secondary btn-sm mr-1" data-toggle="modal" data-target="#cetakPresensiTanggal" style="display: inline;">
                                    Cetak data berdasarkan tanggal & Nip
                                </button>

                                <button type="button" class="btn btn-dark btn-sm mr-1" data-toggle="modal" data-target="#cetakPresensiCatatan" style="display: inline;">
                                    Cetak data berdasarkan catatan
                                </button>


                                <!-- Modal -->
                                <form action="humas_cetakAbsensiByTanggal.php" method="get" target="_blank">
                                    <div class="modal fade" id="cetakPresensiTanggal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cetak Presensi Berdasarkan Tanggal & Nip</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="nip">NIP</label>
                                                        <select name="nip" id="nip" class="form-control js-tanggal" style="width: 100%;">
                                                            <option value="" selected disabled hidden></option>
                                                            <?php
                                                            foreach ($pegawai as $row) { ?>
                                                                <option value="<?= $row['nip']; ?>"> <?= $row['nip']; ?> - <?= $row['nama']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <small style="color: red;">* Sesuaikan NIP</small>
                                                    </div>

                                                    <div class="row">

                                                        <div class="form-group col-lg-6">
                                                            <input type="date" class="form-control" name="dari" id="">
                                                        </div>

                                                        <div class="form-group col-lg-6">
                                                            <input type="date" class="form-control" name="sampai" id="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <!-- Modal -->
                                <form action="humas_cetakAbsensiByCatatan.php" method="get" target="_blank">
                                    <div class="modal fade" id="cetakPresensiCatatan" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Cetak Presensi Berdasarkan Catatan</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">

                                                    <div class="form-group">
                                                        <label for="catatan">Catatan</label>
                                                        <select name="catatan" id="catatan" class="form-control" style="width: 100%;" required>
                                                            <option value="" selected disabled hidden></option>
                                                            <option value="hadir">Hadir</option>
                                                            <option value="terlambat">Terlambat</option>
                                                            <option value="tanpa keterangan">Tanpa Keterangan</option>
                                                        </select>
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>







                        </div>

                        <hr>

                        <div class="container col-lg-12 p-3">
                            <table id="testing" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nip & Nama</th>
                                        <th>Tanggal Absen</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nip & Nama</th>
                                        <th>Tanggal</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Catatan</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($absensi as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['nip']; ?><br><?= $row['nama']; ?></td>
                                            <td><?= date('d-m-Y', strtotime($row['tanggal_absen'])); ?></td>

                                            <!-- jam masuk -->
                                            <?php if ($row['jam_masuk'] == 'belum tercatat') : ?>
                                                <td style="color: red;"><?= $row['jam_masuk']; ?></td>
                                            <?php elseif ($row['jam_masuk'] >= '07:30:00') : ?>
                                                <td style="color: red;"><?= $row['jam_masuk']; ?></td>
                                            <?php elseif ($row['jam_masuk'] < '07:30:00') : ?>
                                                <td style="color: green;"><?= $row['jam_masuk']; ?></td>
                                            <?php endif; ?>

                                            <!-- jam pulang -->
                                            <?php if ($row['jam_pulang'] == 'belum tercatat') : ?>
                                                <td style="color: red;"><?= $row['jam_pulang']; ?></td>
                                            <?php elseif ($row['jam_pulang'] >= '17:00:00') : ?>
                                                <td style="color: green;"><?= $row['jam_pulang']; ?></td>
                                            <?php elseif ($row['jam_pulang'] < '17:00:00') : ?>
                                                <td style="color: red;"><?= $row['jam_pulang']; ?></td>
                                            <?php endif; ?>

                                            <!-- catatan -->
                                            <?php if ($row['catatan'] == 'hadir') : ?>
                                                <td style="color: green;"><?= $row['catatan']; ?></td>
                                            <?php elseif ($row['catatan'] == 'terlambat') : ?>
                                                <td style="color: red;"><?= $row['catatan']; ?></td>
                                            <?php elseif ($row['catatan'] == 'tanpa keterangan') : ?>
                                                <td style="color: red;"><?= $row['catatan']; ?></td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <hr>

                        <!-- chart 📊 -->
                        <div class="p-4">
                            <canvas id="chartAbsensiHumas"></canvas>
                        </div>

                    </div>
                    <br>
                </div>
            </section>

            <!-- \\End Content Area 👋 -->
        </div>



        <!-- Footer -->
        <?php require_once 'templates/footer.php' ?>
    </div>

</body>

<!-- PER SCRIPT AN DUNIAWI 👩‍🔬 -->

<?php require_once 'templates/script.php' ?>
<script src="js/script.js"></script>

<!-- Scipt untuk Chart.Js-->
<script>
    const ctx = document.getElementById('chartAbsensiHumas');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: '<?php
                        if (isset($_GET['tahun']) && isset($_GET['status'])) {
                            echo $tahun . ' - ' . $status;
                        } else {
                            echo $tahunSekarang . ' - Hadir';
                        }
                        ?>',
                data: [<?= $absensiDataString; ?>],
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(function() {
        $('#testing').DataTable()
    });

    $(document).ready(function() {

        $('.js-tanggal').select2({
            dropdownParent: $('#cetakPresensiTanggal')
        });
    });
</script>

</html>