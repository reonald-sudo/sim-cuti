<?php
session_start();

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
                            <h1 class="m-0">Gaji dan tunjangan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Gaji dan tunjangan</a></li>
                                <li class="breadcrumb-item active">Admin</li>
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
                            <img src="dist/img/gajian.jpg" alt="" style="width: 210px;" class="float-right pl-3">
                            <h4>Data keseluruhan gaji dan tunjangan pegawai</h4>
                            <p><em>Berisikan data gaji pegawai beserta tunjangan yang diterima per satu bulan.</em></p>

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
                                        <th>Id</th>
                                        <th>Nip</th>
                                        <th>Nama</th>
                                        <th>Hadir</th>
                                        <th>Terlambat</th>
                                        <th>T Ket</th>
                                        <th>K Gaji</th>
                                        <th>Gaji</th>
                                        <th>K Tun</th>
                                        <th>Tun</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Verifikasi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Id</th>
                                        <th>Nip</th>
                                        <th>Nama</th>
                                        <th>Hadir</th>
                                        <th>Terlambat</th>
                                        <th>T Ket</th>
                                        <th>K Gaji</th>
                                        <th>Gaji</th>
                                        <th>K Tun</th>
                                        <th>Tun</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Verifikasi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($cuti as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td>AB2S3</td>
                                            <td>333</td>
                                            <td>Reonald</td>
                                            <td>25</td>
                                            <td>4</td>
                                            <td>0</td>
                                            <td>FF556</td>
                                            <td>Rp. 2.500.000</td>
                                            <td>DEA331</td>
                                            <td>Rp. 200.000</td>
                                            <td>Rp. 2.700.000</td>
                                            <td>Proses</td>

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
                                                                            <option value="acc admin">Acc</option>
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

</html>