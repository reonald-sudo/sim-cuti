<?php
session_start();
require_once 'functions.php' ?>
<?php require_once 'templates/header.php' ?>

<?php

if (!isset($_SESSION['login'])) {
    header('Location:login.php');
} else {
    $nip = $_SESSION['nip'];
    $password = $_SESSION['password'];
    $hakAses = $_SESSION['hak_akses'];
}

$kode_tunjangan = $_GET['kode_tunjangan'];

if (hapusTunjangan($kode_tunjangan) > 0) {
    echo "
    <script>
        document.location.href = 'admin_tunjangan.php';
        alert('Data berhasil terhapus !');
    </script>
    ";
} else {
    mysqli_error($conn);
}

require_once 'templates/script.php';
