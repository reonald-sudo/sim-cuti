<!DOCTYPE html>
<html lang="en">

<?php

require_once 'functions.php';
require_once 'templates/header.php'

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

                            <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#cetakPresensiNip">
                                Cetak data berdasarkan nip
                            </button>

                            <button type="button" class="btn btn-secondary btn-sm mr-1" data-toggle="modal" data-target="#cetakPresensiTanggal" style="display: inline;">
                                Cetak data berdasarkan tanggal
                            </button>

                            <button type="button" class="btn btn-dark btn-sm mr-1" data-toggle="modal" data-target="#cetakPresensiCatatan" style="display: inline;">
                                Cetak data berdasarkan catatan
                            </button>

                            <!-- Modal -->
                            <form action="admin_cetakAbsensiByNip.php" method="get" target="_blank">
                                <div class="modal fade" id="cetakPresensiNip" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cetak Presensi Berdasarkan NIP</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="nip" id="" placeholder="Nip">
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
                            <form action="admin_cetakAbsensiByTanggal.php" method="get" target="_blank">
                                <div class="modal fade" id="cetakPresensiTanggal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cetak Presensi Berdasarkan Tanggal</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
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
                                <div class="modal fade" id="cetakPresensiCatatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <input type="text" class="form-control" name="catatan" id="" placeholder="Hadir">
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
                                        <th>Nama</th>
                                        <th>Nip</th>
                                        <th>Tanggal Absen</th>
                                        <th>Jam Masuk</th>
                                        <th>Jam Pulang</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Nip</th>
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
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['nip']; ?></td>
                                            <td><?= $row['tanggal_absen']; ?></td>
                                            <td><?= $row['jam_masuk']; ?></td>
                                            <td><?= $row['jam_pulang']; ?></td>
                                            <td><?= $row['catatan']; ?></td>
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

</html>