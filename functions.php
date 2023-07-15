<?php

$conn = mysqli_connect('localhost', 'root', '', 'db_sim_cuti');

// MENAMPILKAN DATABASE DI DEPAN
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function showSingleTable($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function editData($detail)
{
    global $conn;
    $result = mysqli_query($conn, $detail);
    $row = mysqli_fetch_assoc($result);

    return $row;
}

function uploadNota()
{
    $namaFile = $_FILES['nota']['name'];
    $tmpFile = $_FILES['nota']['tmp_name'];
    $errorFile = $_FILES['nota']['error'];
    $sizeFile = $_FILES['nota']['size'];

    // cek apakah file di up
    if ($errorFile === 4) {
        $fileDefault = 'Tidak diupload';
        return $fileDefault;
    }

    // cek apakah file yg di up pdf atau bukan
    $extensionsFile = ['img', 'png', 'jpeg', 'jpg'];
    $extensionsFileUp = explode('.', $namaFile);
    $extensionsFileUp = strtolower(end($extensionsFile));

    if (!in_array($extensionsFileUp, $extensionsFile)) {
        echo "<script>
                alert ('File yang anda unggah bukan gambar!');
        </script>";
        return false;
    }

    // cek ukuran gambar
    if ($sizeFile >= 6500000000000) {
        echo "<script>
                alert ('File Yang Anda Unggah Terlalu Besar');
        </script>";
        return false;
    }

    // gambar siap di upload
    move_uploaded_file($tmpFile, 'dist/img/' . $namaFile);

    return $namaFile;
}

function uploadSuratPengajuan()
{
    $namaFile = $_FILES['surat_pengajuan']['name'];
    $tmpFile = $_FILES['surat_pengajuan']['tmp_name'];
    $errorFile = $_FILES['surat_pengajuan']['error'];
    $sizeFile = $_FILES['surat_pengajuan']['size'];

    // cek apakah file di up
    if ($errorFile === 4) {
        $fileDefault = 'Tidak diupload';
        return $fileDefault;
    }

    // cek apakah file yg di up pdf atau bukan
    $extensionsFile = ['pdf'];
    $extensionsFileUp = explode('.', $namaFile);
    $extensionsFileUp = strtolower(end($extensionsFile));

    if (!in_array($extensionsFileUp, $extensionsFile)) {
        echo "<script>
                alert ('File yang anda unggah bukan dokumen!');
        </script>";
        return false;
    }

    // cek ukuran gambar
    if ($sizeFile >= 6500000000000) {
        echo "<script>
                alert ('File Yang Anda Unggah Terlalu Besar');
        </script>";
        return false;
    }

    // gambar siap di upload
    move_uploaded_file($tmpFile, 'dist/pdf/' . $namaFile);

    return $namaFile;
}

// hitung query
function hitungBaris($query)
{
    global $conn;

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function tambahAbsensi($data)
{
    date_default_timezone_set('Asia/kuala_lumpur');
    global $conn;

    $tanggal = date('Y-m-d');
    $nip = $data['nip'];
    $nama = $data['nama'];
    $catatan = 'hadir';
    $jamMasuk = date('H:i:s');
    $jamPulang = 'Belum Tercatat';
    $tunjangan = $data['tunjangan'];

    $tanggal = date('Y-m-d');
    $stmt = hitungBaris("SELECT * FROM tb_absensi WHERE tanggal_absen = '$tanggal' AND nip = '$nip'");

    if ($stmt > 0) {
        $stmt = 0;

        return $stmt;
    } elseif ($stmt == 0) {
        $query = "INSERT INTO tb_absensi VALUE ('', '$nip', '$nama', '$tanggal', '$jamMasuk', '$jamPulang', '$catatan', '$tunjangan')";

        mysqli_query($conn, $query);
    }

    return mysqli_affected_rows($conn);
}

function tambahPulangKerja($data)
{
    global $conn;
    date_default_timezone_set('Asia/kuala_lumpur');

    $tanggalAbsen = $data['tanggalAbsen'];
    $nip = $data['nip'];
    $jamPulang = date('H:i:s');

    $tanggal = date('Y-m-d');
    $stmt = hitungBaris("SELECT * FROM tb_absensi WHERE tanggal_absen = '$tanggal' AND nip = '$nip' AND jam_pulang = 'belum tercatat'");

    if ($stmt > 0) {

        $query = "UPDATE tb_absensi SET jam_pulang = '$jamPulang' WHERE tanggal_absen = '$tanggalAbsen' AND nip = '$nip'";

        mysqli_query($conn, $query);
    } else {
        $stmt = 0;

        return $stmt;
    }

    return mysqli_affected_rows($conn);
}

function tambahPengguna($data)
{
    global $conn;

    $nip = $data['nip'];
    $golongan = $data['golongan'];
    $nama = $data['nama'];
    $password = $data['password'];
    $hakAkses = $data['hakAkses'];

    $query = "INSERT INTO user VALUE ('$nip', '$golongan', '$nama', '$hakAkses', '$password')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahPengajuanUang($data)
{

    global $conn;

    $nip = $data['nip'];
    $nama = $data['nama'];
    $tanggalTransaksi = $data['tanggalTransaksi'];
    $nominal = $data['nominal'];
    $nota = uploadNota();
    $status = $data['status'];
    $alasan = $data['alasan'];

    $query = "INSERT INTO tb_uang_ganti VALUE('', '$nip', '$nama', '$tanggalTransaksi', '$nominal', '$nota', '$status', '$alasan')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahCuti($data)
{
    global $conn;

    $nip = $data['nip'];
    $nama = $data['nama'];
    $tanggalCuti = $data['tanggalCuti'];
    $hari = $data['hari'];
    $tanggalKembali = $data['tanggalKembali'];
    $status = $data['status'];
    $surat_pengajuan = uploadSuratPengajuan();
    $alasan = $data['alasan'];

    $query = "INSERT INTO tb_cuti VALUE ('', '$nip', '$nama', '$tanggalCuti', '$hari', '$tanggalKembali', '$status', '$surat_pengajuan', '$alasan')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function tambahPegawai($data)
{
    global $conn;

    $nip = $data['nip'];
    $nama = $data['nama'];
    $golongan = $data['golongan'];
    $alamat = $data['alamat'];
    $no_telp = $data['no_telp'];
    $email = $data['email'];

    $query = "INSERT INTO pegawai VALUE('$nip', '$nama', '$golongan', '$alamat', '$no_telp', '$email')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahPegawai($data)
{
    global $conn;

    $nip = $data['nip'];
    $nama = $data['nama'];
    $golongan = $data['golongan'];
    $alamat = $data['alamat'];
    $no_telp = $data['no_telp'];
    $email = $data['email'];

    $query = "UPDATE pegawai SET nama = '$nama', golongan = '$golongan', alamat = '$alamat', no_telp = '$no_telp', email = '$email' WHERE nip = '$nip'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahPengguna($data)
{
    global $conn;

    $nip = $data['nip'];
    $golongan = $data['golongan'];
    $nama = $data['nama'];
    $password = $data['password'];
    $hakAkses = $data['hakAkses'];

    $query = "UPDATE user SET golongan = '$golongan', nama = '$nama', password = '$password', hak_akses = '$hakAkses' WHERE nip = '$nip'";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function ubahPengajuanUang($data)
{
    global $conn;

    $id = $data['id'];
    $nip = $data['nip'];
    $tanggalTransaksi = $data['tanggalTransaksi'];
    $nominal = $data['nominal'];
    $nota = uploadNota();
    $status = $data['status'];

    $query = "UPDATE tb_uang_ganti SET nip = '$nip', tanggal_transaksi = '$tanggalTransaksi', nominal = '$nominal', nota = '$nota', status = '$status' WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahCuti($data)
{
    global $conn;

    $id = $data['id'];
    $nip = $data['nip'];
    $tanggalCuti = $data['tanggalCuti'];
    $hari = $data['hari'];
    $tanggalKembali = $data['tanggalKembali'];
    $status = $data['status'];
    $surat_pengajuan = uploadSuratPengajuan();

    $query = "UPDATE tb_cuti SET nip = '$nip', tanggal_cuti = '$tanggalCuti', hari = '$hari', tanggal_kembali = '$tanggalKembali', status = '$status', surat_pengajuan = '$surat_pengajuan' WHERE id = '$id'";

    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapusPengguna($id)
{
    global $conn;

    $query = "DELETE FROM user WHERE nip = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusUangGanti($id)
{
    global $conn;

    $query = "DELETE FROM tb_uang_ganti WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusUangGantiAcc($status)
{
    global $conn;

    $query = "DELETE FROM tb_uang_ganti WHERE status = '$status'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusCuti($id)
{
    global $conn;

    $query = "DELETE FROM tb_cuti WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapusPegawai($nip)
{
    global $conn;

    $query = "DELETE FROM pegawai WHERE nip = '$nip'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function verifikasiPengajuan($data)
{
    global $conn;

    $id = $data['id'];
    $verifikasiPengajuan = $data['verifikasiPengajuan'];
    $statusDitolak = $data['statusDitolak'];

    $query = "UPDATE tb_uang_ganti SET status = '$verifikasiPengajuan', alasan = '$statusDitolak' WHERE id = '$id'";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function verifikasiPengajuanCuti($data)
{
    global $conn;

    $id = $data['id'];
    $verifikasiCuti = $data['verifikasiCuti'];
    $statusDitolak = $data['statusDitolak'];

    $query = "UPDATE tb_cuti SET status = '$verifikasiCuti', alasan = '$statusDitolak' WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// penggajian

// tambah data
function tambahDataGaji($data)
{
    global $conn;

    $kodeGaji = $data['kodeGaji'];
    $golongan = $data['golongan'];
    $gaji = $data['gaji'];

    $query = "INSERT INTO tb_penggajian VALUE ('$kodeGaji', '$golongan', '$gaji')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// edit
function ubahGaji($data)
{
    global $conn;

    $kodeGaji = $data['kodeGaji'];
    $golongan = $data['golongan'];
    $gaji = $data['gaji'];

    $query = "UPDATE tb_penggajian SET golongan = '$golongan', gaji = '$gaji' WHERE kode_gaji = '$kodeGaji'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// hapus
function hapusGaji($kode_gaji)
{
    global $conn;

    $query = "DELETE FROM tb_penggajian WHERE kode_gaji = '$kode_gaji'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


// tunjangan

// tambah data
function tambahTunjangan($data)
{
    global $conn;

    $kodeTunjangan = $data['kodeTunjangan'];
    $golongan = $data['golongan'];
    $hadir = $data['hadir'];
    $terlambat = $data['terlambat'];
    $tanpaKeterangan = $data['tanpaKeterangan'];

    $query = "INSERT INTO tb_tunjangan VALUE ('$kodeTunjangan', '$golongan', '$hadir', '$terlambat', '$tanpaKeterangan')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// edit
function ubahTunjangan($data)
{
    global $conn;

    $kodeTunjangan = $data['kodeTunjangan'];
    $golongan = $data['golongan'];
    $hadir = $data['hadir'];
    $terlambat = $data['terlambat'];
    $tanpaKeterangan = $data['tanpaKeterangan'];

    $query = "UPDATE tb_tunjangan SET golongan = '$golongan', hadir = '$hadir', terlambat = '$terlambat', tanpa_keterangan = '$tanpaKeterangan' WHERE kode_tunjangan = '$kodeTunjangan'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// hapus
function hapusTunjangan($kode_tunjangan)
{
    global $conn;

    $query = "DELETE FROM tb_tunjangan WHERE kode_tunjangan = '$kode_tunjangan'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
