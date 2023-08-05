<?php
session_start();

require_once 'functions.php';
require_once 'templates/header.php';

$pegawai = query("SELECT * FROM pegawai");


if (isset($_POST['verifikasi'])) {
    if (verifikasiGajidanTunjangan($_POST) > 0) {
        echo "<script>
        alert('berhasil diverifikasi');
        document.location.href = 'admin_GajidanTunjangan.php';
        </script>";
    }
}

$gajiTunjangan = showSingleTable("SELECT * FROM tb_tunjangan_dan_gaji_pegawai");

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

                            <a href="admin_CetakSeluruhDataGaji.php" class="btn btn-primary btn-sm mr-1" target="_blank">
                                Cetak seluruh data
                            </a>

                            <button type="button" class="btn btn-warning btn-sm mr-1" data-toggle="modal" data-target="#cetakGajiTunjangan">
                                Cetak data berdasarkan nip & status
                            </button>

                            <!-- Modal -->
                            <form action="admin_cetakGajiTunjangan.php" method="get" target="_blank">
                                <div class="modal fade" id="cetakGajiTunjangan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Cetak Presensi Berdasarkan NIP & Status</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="nip">NIP</label>
                                                    <select name="nip" id="nip" class="form-control js-example-basic-single" style="width: 100%;" required>
                                                        <option value="" selected disabled hidden></option>
                                                        <?php
                                                        foreach ($pegawai as $row) { ?>
                                                            <option value="<?= $row['nip']; ?>"> <?= $row['nip']; ?> - <?= $row['nama']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <small style="color: red;">* Sesuaikan NIP</small>
                                                </div>

                                                <div class="form-group">
                                                    <select class="form-control verifikasiGajiTunjangan" aria-label="Default select example" name="verifikasiGajiTunjangan">
                                                        <option selected>Verifikasi Gaji dan Tunjangan</option>
                                                        <option value="acc humas">Acc Humas</option>
                                                        <option value="acc admin">Acc Admin</option>
                                                        <option value="ditolak">Ditolak</option>
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
                                        <th>Bulan</th>
                                        <th>Nip & Nama</th>
                                        <th>Golongan</th>
                                        <th>Hadir</th>
                                        <th>Tlambat</th>
                                        <th>T Ket</th>
                                        <th>Gaji</th>
                                        <th>Tun</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Bulan</th>
                                        <th>Nip & Nama </th>
                                        <th>Golongan</th>
                                        <th>Hadir</th>
                                        <th>Tlambat</th>
                                        <th>T Ket</th>
                                        <th>Gaji</th>
                                        <th>Tun</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Opsi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($gajiTunjangan as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['bulan'] ?></td>
                                            <td><?= $row['nip']; ?> <br> <?= $row['nama']; ?></td>
                                            <td><?= $row['golongan']; ?></td>
                                            <td><?= $row['jumlah_hadir']; ?></td>
                                            <td><?= $row['jumlah_terlambat']; ?></td>
                                            <td><?= $row['jumlah_tanpa_keterangan']; ?></td>
                                            <td style="color: green;">Rp. <?= number_format($row['gaji'], 0, ",", "."); ?></td>
                                            <td style="color: green;">Rp. <?= number_format($row['tunjangan'], 0, ",", "."); ?></td>
                                            <td style="color: green;">Rp. <?= number_format($row['total_gaji'], 0, ",", "."); ?></td>
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
                                                                    <h5 class="modal-title" id="exampleModalLabel">Verifikasi gaji</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="id" value="<?= $row['id']; ?>">

                                                                    <div class="form-group">
                                                                        <select class="form-control verifikasiGajiTunjangan" aria-label="Default select example" name="verifikasiGajiTunjangan" required>
                                                                            <option value="" selected disabled hidden>Pilih Verifikasi Gaji dan Tunjangan</option>
                                                                            <option value="acc admin">Acc</option>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('.js-example-basic-single').select2({
        dropdownParent: $('#cetakGajiTunjangan')
    });
</script>

</html>