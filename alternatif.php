<?php
session_start();
include "config.php";

// Ambil semua alternatif
$q = mysqli_query($conn, "SELECT * FROM alternatif ORDER BY id_alternatif ASC");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Data Alternatif</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>

<body>

<div class="main-wrapper d-flex justify-content-center align-items-center">
    <?php include "layout/sidebar.php"; ?>
    <div class="content-area">
        <h3 class="mb-4 text-center" style="color:#ff4f9a;">Data Alternatif</h3>
        <a href="tambah_alternatif.php" class="btn btn-primary mb-3">+ Tambah Alternatif</a>
        <div class="card pastel-card shadow">
            <div class="card-body">
            <table class="table table-bordered pastel-table">
            <thead>
                <tr>
                    <th>Kode Alternatif</th>
                    <th>Nama Alternatif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php while ($row = mysqli_fetch_assoc($q)) { ?>
                <tr>
                    <td><?= $row['kode_alternatif'] ?></td>
                    <td><?= $row['nama_alternatif'] ?></td>
                    <td>
                        <a href="edit_alternatif.php?id=<?= $row['id_alternatif'] ?>" 
                           class="btn btn-warning btn-sm">Edit</a>
                        <a href="hapus_alternatif.php?id=<?= $row['id_alternatif'] ?>" 
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Hapus alternatif ini?')">
                            Hapus
                        </a>

                    </td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
        </div>
        </div>
    </div>

</div>
</body>
</html>
