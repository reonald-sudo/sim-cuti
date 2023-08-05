<?php

require '../functions.php';

$nip = $_GET['nip'];

$nipPegawai = editData("SELECT * FROM pegawai WHERE nip='$nip' ");

$response = array(
    'golongan' => $nipPegawai['golongan'],
    'nama' => $nipPegawai['nama']
);

header('Content-Type: application/json');


echo json_encode($response);
