<?php
// session_start();

require_once 'functions.php';

if (!isset($_SESSION['login'])) {
    header('Location:../login.php');
} else {
    $nip = $_SESSION['nip'];
    $password = $_SESSION['password'];
    $hakAses = $_SESSION['hak_akses'];
}
?>

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <?php if ($_SESSION['hak_akses'] == 'user') {
                    ?>
                        <li class="breadcrumb-item active">Dashboard User</li>
                    <?php
                    } else if ($_SESSION['hak_akses'] == 'admin') {
                    ?>
                        <li class="breadcrumb-item active">Dashboard Admin</li>
                    <?php
                    } else if ($_SESSION['hak_akses'] == 'humas') { ?>
                        <li class="breadcrumb-item active">Dashboard Humas</li>
                    <?php } else if ($_SESSION['hak_akses'] == 'bendahara') { ?>
                        <li class="breadcrumb-item active">Dashboard Bendahara</li>
                    <?php } ?>
                </ol>
            </div>
        </div>
    </div>
</div>