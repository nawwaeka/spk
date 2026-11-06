<?php
session_start();
include "config.php";

if (!isset($_POST['id_kriteria'])) {
    header("Location: data_kriteria.php");
    exit;
}

$id    = $_POST['id_kriteria'];
$kode  = $_POST['kode_kriteria'];
$nama  = $_POST['nama_kriteria'];
$sifat = $_POST['sifat'];

mysqli_query($conn, "UPDATE kriteria SET
    kode_kriteria = '$kode',
    nama_kriteria = '$nama',
    sifat = '$sifat'
    WHERE id_kriteria = '$id'
");

header("Location: data_kriteria.php?success=edit");
exit;
