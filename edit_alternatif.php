<?php
session_start();
include "config.php";
include "layout/sidebar.php";

$id = $_GET['id'];

$q = mysqli_query($conn, "SELECT * FROM alternatif WHERE id_alternatif=$id");
$data = mysqli_fetch_assoc($q);

if (isset($_POST['update'])) {
    $kode = $_POST['kode_alternatif'];
    $nama = $_POST['nama_alternatif'];

    mysqli_query($conn, "UPDATE alternatif SET 
        kode_alternatif='$kode',
        nama_alternatif='$nama'
        WHERE id_alternatif=$id");

    header("Location: alternatif.php?success=edit");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Alternatif</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>
<div class="main-wrapper d-flex">

    <?php include "layout/sidebar.php"; ?>

    <div class="content-area">

        <h3 class="mb-4" style="color:#ff4f9a;">Edit Alternatif</h3>

        <form method="POST" class="card p-4 pastel-card" style="max-width:500px;">

            <div class="mb-3">
                <label class="form-label">Kode Alternatif</label>
                <input type="text" name="kode_alternatif" class="form-control"
                       value="<?= $data['kode_alternatif'] ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Alternatif</label>
                <input type="text" name="nama_alternatif" class="form-control"
                       value="<?= $data['nama_alternatif'] ?>" required>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update</button>
        </form>

    </div>

</div>
</body>
</html>
