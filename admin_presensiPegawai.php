<?php
session_start();
require_once 'functions.php';
require_once 'templates/header.php';


$pegawai = query("SELECT * FROM pegawai");

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
                            <h1 class="m-0">Data presensi pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Data presensi pegawai</a></li>
                                <li class="breadcrumb-item active">Dashboard Admin</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card">
                        <div class="card-header mb-0">
                            <img src="dist/img/presensi_admin.jpg" alt="" style="width: 290px;" class="float-right pl-3">
                            <h4>Data presensi pegawai pengadilan negeri banjarbaru</h4>
                            <p><em>Berisikan data presensi para pegawai pengadilan negeri banjarbaru yang tercatat pada aplikasi SIM Cuti</em></p>
                            <p style="margin: 0px; padding: 0px;"><b>Total Presensi Tercatat SIM CUTI</b></p>
                            <?php $absensi = hitungBaris("SELECT * FROM tb_absensi"); ?>
                            <p class="badge badge-primary"><?= $absensi; ?> Data</p>
                            <br>

                            <button type="button" class="btn btn-secondary btn-sm mr-1" data-toggle="modal" data-target="#cetakPresensiTanggal" style="display: inline;">
                                Cetak data berdasarkan tanggal & Nip
                            </button>

                            <button type="button" class="btn btn-dark btn-sm mr-1" data-toggle="modal" data-target="#cetakPresensiCatatan" style="display: inline;">
                                Cetak data berdasarkan catatan
                            </button>


                            <!-- Modal -->
                            <form action="admin_cetakAbsensiByTanggal.php" method="get" target="_blank">
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
                            <form action="admin_cetakAbsensiByCatatan.php" method="get" target="_blank">
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
                                    <?php $absensi = query("SELECT * FROM tb_absensi"); ?>
                                    <?php $i = 1; ?>
                                    <?php foreach ($absensi as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['nip']; ?><br><?= $row['nama']; ?></td>
                                            <td><?= $row['tanggal_absen']; ?></td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>
    $(function() {
        $('#testing').DataTable()
    });
</script>

<script>
    $(document).ready(function() {

        $('.js-tanggal').select2({
            dropdownParent: $('#cetakPresensiTanggal')
        });
    });
</script>

</html>