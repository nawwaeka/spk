<?php
session_start();
include "config.php";

// Ambil semua alternatif
$alternatif = mysqli_query($conn, "SELECT * FROM alternatif ORDER BY id_alternatif ASC");

// Ambil semua kriteria
$kriteria = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");

// Jika form disubmit
if (isset($_POST['save'])) {
    foreach ($_POST['nilai'] as $alt_id => $nilai_kriteria) {
        foreach ($nilai_kriteria as $krit_id => $nilai) {

            $nilai = (double)$nilai;

            mysqli_query($conn, "
                INSERT INTO penilaian (id_alternatif, id_kriteria, nilai)
                VALUES ('$alt_id', '$krit_id', '$nilai')
                ON DUPLICATE KEY UPDATE nilai='$nilai'
            ") or die(mysqli_error($conn));
        }
    }
    header("Location: penilaian.php?success=1");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Penilaian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="main-wrapper d-flex justify-content-center align-items-start">

    <?php include "layout/sidebar.php"; ?>

    <div class="content-area">
        <h3 class="mb-4 text-center" style="color:#ff4f9a;">Penilaian Alternatif</h3>

        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Penilaian berhasil disimpan!</div>
        <?php endif; ?>

        <form method="post">
            <div class="card pastel-card shadow p-3 mb-3">
                <table class="table table-bordered pastel-table text-center">
                    <thead>
                        <tr>
                            <th>Alternatif</th>
                            <?php while ($k = mysqli_fetch_assoc($kriteria)) { ?>
                                <th><?= $k['nama_kriteria'] ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($alt = mysqli_fetch_assoc($alternatif)) { ?>
                        <tr>
                            <td><?= $alt['nama_alternatif'] ?></td>

                            <?php
                            // Reset pointer kriteria agar bisa loop lagi
                            mysqli_data_seek($kriteria, 0);
                            while ($k = mysqli_fetch_assoc($kriteria)) {
                                // Ambil nilai sebelumnya jika ada
                                $qnilai = mysqli_query($conn, "SELECT nilai FROM penilaian WHERE id_alternatif='{$alt['id_alternatif']}' AND id_kriteria='{$k['id_kriteria']}'");
                                $nilai_lama = mysqli_fetch_assoc($qnilai)['nilai'] ?? '';
                            ?>
                                <td>
                                    <input type="number" name="nilai[<?= $alt['id_alternatif'] ?>][<?= $k['id_kriteria'] ?>]" 
                                           class="form-control" value="<?= $nilai_lama ?>" required>
                                </td>
                            <?php } ?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <button type="submit" name="save" class="btn btn-primary mt-3">Simpan Penilaian</button>
            </div>
        </form>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
