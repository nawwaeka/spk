<?php
session_start();
include "config.php";
include "layout/sidebar.php";

if (isset($_POST['save'])) {
    $kode = $_POST['kode_alternatif'];
    $nama = $_POST['nama_alternatif'];

    mysqli_query($conn, "INSERT INTO alternatif (kode_alternatif, nama_alternatif) VALUES ('$kode', '$nama')");

    header("Location: alternatif.php?success=add");
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tambah Alternatif</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
<div class="main-wrapper d-flex">

    <?php include "layout/sidebar.php"; ?>

    <div class="content-area">

        <h3 class="mb-4" style="color:#ff4f9a;">Tambah Alternatif</h3>

        <form method="POST" class="card p-4 pastel-card" style="max-width:500px;">
            <div class="mb-3">
                <label class="form-label">Kode Alternatif</label>
                <input type="text" name="kode_alternatif" class="form-control" required placeholder="Misal: A1">
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Alternatif</label>
                <input type="text" name="nama_alternatif" class="form-control" required>
            </div>

            <button type="submit" name="save" class="btn btn-primary">Simpan</button>
        </form>

    </div>

</div>
</body>
</html>
