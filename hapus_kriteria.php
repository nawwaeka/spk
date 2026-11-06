<?php
include 'config.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM penilaian WHERE id_kriteria='$id'");

mysqli_query($conn, "DELETE FROM kriteria WHERE id_kriteria='$id'");

header("Location:data_kriteria.php");
?>
