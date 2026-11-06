<?php
include 'config.php';

$id = $_GET['id'];

// hapus penilaian dulu
mysqli_query($conn, "DELETE FROM penilaian WHERE id_alternatif='$id'");

// hapus hasil topsis
mysqli_query($conn, "DELETE FROM hasil_topsis WHERE id_alternatif='$id'");

// baru hapus alternatif
mysqli_query($conn, "DELETE FROM alternatif WHERE id_alternatif='$id'");

header("Location: alternatif.php");
?>
