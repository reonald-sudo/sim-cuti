<!DOCTYPE html>
<html lang="en">

<?php
require_once 'functions.php';
require_once 'templates/header.php';

$tbTunjanganDanGaji = query("SELECT * FROM tb_tunjangan_dan_gaji_pegawai");

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
                            <h1 class="m-0">Data Validasi Penggajian Pegawai</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Data Validasi Penggajian Pegawai</a></li>
                                <li class="breadcrumb-item active">Dashboard Bendahara</li>
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
                            <h4>Validasi penggajian pegawai</h4>
                            <p><em>Berikut merupakan data yang harus divalidasi untuk pengesahan penggajian</em></p>

                            <button type="button" class="btn btn-secondary btn-sm mr-1" data-toggle="modal" data-target="#cetakPengajuanByTanggal" style="display: inline;">
                                Cetak keseluruhan
                            </button>

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
                                        <th>Nip</th>
                                        <th>Nama</th>
                                        <th>H</th>
                                        <th>T</th>
                                        <th>TK</th>
                                        <th>K Gaji</th>
                                        <th>K Tunj</th>
                                        <th>Total Gaji</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nip</th>
                                        <th>Nama</th>
                                        <th>H</th>
                                        <th>T</th>
                                        <th>TK</th>
                                        <th>K Gaji</th>
                                        <th>K Tunj</th>
                                        <th>Total Gaji</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>

                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php $total = 0 ?>

                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td>#</td>
                                        <td>#</td>
                                        <td>#</td>
                                        <td>#</td>
                                        <td>#</td>
                                        <td>#</td>
                                        <td>#</td>
                                        <td>#</td>

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