<!DOCTYPE html>
<html lang="en">

<?php
require_once 'functions.php';
require_once 'templates/header.php';

$uangGantiAdmin = query("SELECT * FROM tb_uang_ganti");

if (isset($_POST['verifikasi'])) {
    if (verifikasiPengajuan($_POST) > 0) {
        echo "<script>
        alert('berhasil diverifikasi');
        document.location.href = 'admin_pengajuanUangGanti.php';
        </script>";
    }
}

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
                            <h1 class="m-0">Data Pengajuan Uang Ganti</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Data Pengajuan Uang Ganti</a></li>
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
                            <img src="dist/img/duitadmin.jpg" alt="" style="width: 250px;" class="float-right pl-3">
                            <h4>Pengajuan uang ganti</h4>
                            <p><em>Berikut merupakan data uang ganti yang tercatat pada SIM Cuti</em></p>
                            <p style="margin: 0px; padding: 0px;"><b>Total pengajuan peggantian uang yang tercatat pada SIM CUTI</b></p>
                            <?php $uangGanti = hitungBaris("SELECT * FROM tb_uang_ganti"); ?>
                            <p><?= $uangGanti; ?></p>

                            <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#cetakPengajuanByNip">
                                Cetak data berdasarkan nip
                            </button>

                            <button type="button" class="btn btn-secondary btn-sm mr-1" data-toggle="modal" data-target="#cetakPengajuanByTanggal" style="display: inline;">
                                Cetak data berdasarkan tanggal transaksi
                            </button>

                            <!-- Modal -->
                            <form action="admin_cetakPengajuanByNip.php" method="get" target="_blank">
                                <div class="modal fade" id="cetakPengajuanByNip" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cetak Pengajuan Berdasarkan NIP</h5>
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
                            <form action="admin_cetakPengajuanByTanggal.php" method="get" target="_blank">
                                <div class="modal fade" id="cetakPengajuanByTanggal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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

                        </div>

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
                                    <?php foreach ($uangGantiAdmin as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['nip']; ?></td>
                                            <td><?= $row['tanggal_transaksi']; ?></td>
                                            <td>Rp.<?= $row['nominal']; ?>,-</td>

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
                                            <td><?= $row['status']; ?></td>

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
                                                                        <select class="form-control" aria-label="Default select example" name="verifikasiPengajuan">
                                                                            <option selected>Verifikasi pengajuan</option>
                                                                            <option value="acc">Acc</option>
                                                                            <option value="ditolak">Ditolak</option>
                                                                        </select>
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
</script>

</html>