<!DOCTYPE html>
<html lang="en">

<?php

require_once 'functions.php';
require_once 'templates/header.php';

$cuti = showSingleTable("SELECT * FROM tb_cuti");

if (isset($_POST['verifikasi'])) {
    if (verifikasiPengajuanCuti($_POST) > 0) {
        echo "<script>
        alert('berhasil diverifikasi');
        document.location.href = 'admin_pengajuanCuti.php';
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
                            <h1 class="m-0">Data pengajuan cuti</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Data pengajuan cuti</a></li>
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
                            <img src="dist/img/cutiadmin.jpg" alt="" style="width: 210px;" class="float-right pl-3">
                            <h4>Data pengajuan cuti pegawai pengadilan negeri banjarbaru</h4>
                            <p><em>Berisikan data pengajuan cuti para pegawai pengadilan negeri banjarbaru yang tercatat pada aplikasi SIM Cuti</em></p>
                            <p style="margin: 0px; padding: 0px;"><b>Total Pengajuan Cuti Tercatat Pada SIM CUTI</b></p>
                            <?php $hitungCuti = hitungBaris("SELECT * FROM tb_cuti"); ?>
                            <p class="badge badge-primary"><?= $hitungCuti; ?> Data</p>
                            <br>

                            <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#cetakCutiNip">
                                Cetak data berdasarkan nip
                            </button>

                            <button type="button" class="btn btn-secondary btn-sm mr-1" data-toggle="modal" data-target="#cetakCutiTanggal" style="display: inline;">
                                Cetak data berdasarkan tanggal
                            </button>

                            <!-- Modal -->
                            <form action="admin_cetakCutiByNip.php" method="get" target="_blank">
                                <div class="modal fade" id="cetakCutiNip" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form action="admin_cetakCutiByTanggal.php" method="get" target="_blank">
                                <div class="modal fade" id="cetakCutiTanggal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                        <th>Status</th>
                                        <th>Surat Pengajuan</th>
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
                                        <th>Status</th>
                                        <th>Surat Pengajuan</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($cuti as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['nip']; ?></td>
                                            <td><?= $row['tanggal_cuti']; ?></td>
                                            <td><?= $row['hari']; ?></td>
                                            <td><?= $row['tanggal_kembali']; ?></td>
                                            <td><?= $row['status']; ?></td>

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
                                                                        <select class="form-control" aria-label="Default select example" name="verifikasiCuti">
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