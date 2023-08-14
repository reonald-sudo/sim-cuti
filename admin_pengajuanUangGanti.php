<?php

session_start();

require_once 'functions.php';
require_once 'templates/header.php';

$uangGantiAdmin = query("SELECT * FROM tb_uang_ganti ORDER BY tanggal_transaksi DESC");

if (isset($_POST['verifikasi'])) {
    if (verifikasiPengajuan($_POST) > 0) {
        echo "<script>
        alert('berhasil diverifikasi');
        document.location.href = 'admin_pengajuanUangGanti.php';
        </script>";
    }
}

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
                            <h1 class="m-0">Data reamburstment</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="absensi.php">Data reamburstment</a></li>
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
                            <h4>Reamburstment</h4>
                            <p><em>Berikut merupakan data reamburstment yang tercatat pada SIM Cuti</em></p>
                            <p style="margin: 0px; padding: 0px;"><b>Total reamburstment yang tercatat pada SIM CUTI</b></p>
                            <?php $uangGanti = hitungBaris("SELECT * FROM tb_uang_ganti"); ?>
                            <p><?= $uangGanti; ?></p>

                            <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#cetakPengajuanByNip">
                                Cetak data berdasarkan nip
                            </button>

                            <button type="button" class="btn btn-secondary btn-sm mr-1" data-toggle="modal" data-target="#cetakPengajuanByTanggal" style="display: inline;">
                                Cetak data spesifik
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
                                                <h5 class="modal-title" id="exampleModalLabel">Cetak Reimbursment Spesifik</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="form-group col-lg-4">
                                                        <input type="date" class="form-control" name="dari" id="">
                                                    </div>

                                                    <div class="form-group col-lg-4">
                                                        <input type="date" class="form-control" name="sampai" id="">
                                                    </div>

                                                    <div class="form-group col-lg-4">
                                                        <select class="form-control" aria-label="Default select example" name="status">
                                                            <option selected>Status</option>
                                                            <option value="ditolak">ditolak</option>
                                                            <option value="acc admin">acc admin</option>
                                                            <option value="acc bendahara">acc bendahara</option>
                                                            <option value="acc humas">acc humas</option>
                                                        </select>
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
                                        <th>Nama & Nip</th>
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
                                        <th>Nama & Nip</th>
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
                                            <td><?= $row['nip']; ?><br><?= $row['nama']; ?></td>
                                            <td><?= date('d-m-Y', strtotime($row['tanggal_transaksi'])); ?></td>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


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

    $(document).ready(function() {

        $('.js-tanggal').select2({
            dropdownParent: $('#cetakPengajuanByNip')
        });
    });
</script>

</html>