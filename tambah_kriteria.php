<?php
include 'config.php';

$id = $_POST['id_kriteria'];
$kode = $_POST['kode_kriteria'];
$nama = $_POST['nama_kriteria'];
$sifat = $_POST['sifat'];

mysqli_query($conn, "INSERT INTO kriteria VALUES('$id','$kode','$nama','$sifat')");

header("Location:data_kriteria.php");
?>
