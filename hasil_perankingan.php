<?php
session_start();
include "config.php";

/* ===============================
   AMBIL SEMUA HASIL RANKING
=================================*/
$q = mysqli_query($conn, "
    SELECT 
        h.ranking,
        a.nama_alternatif,
        h.nilai_preferensi
    FROM hasil_topsis h
    JOIN alternatif a ON h.id_alternatif = a.id_alternatif
    ORDER BY h.ranking ASC
");

$data = [];
while($row = mysqli_fetch_assoc($q)){
    $data[] = $row;
}

// Ambil ranking 1
$best = $data[0] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Perankingan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/SPK/assets/style.css?v=<?= time() ?>">
</head>

<body>
<div class="main-wrapper d-flex align-items-start">
    <?php include "layout/sidebar.php"; ?>
    <div class="content-area">
    <h1 class="mt-3 mb-5 text-pink text-center">
        Hasil Akhir Perankingan
    </h1>
    <?php if($best){ ?>

    <!-- WINNER -->
    <div class="card pastel-card shadow mb-5 w-75 mx-auto winner-card">
        <div class="text-center py-4">
            <span class="badge-winner mb-3 d-inline-block">
                🏆 RANKING TERBAIK
            </span>
            <div class="winner-title mt-3">Alternatif Terpilih</div>
            <div class="winner-name mt-2">
                <?= $best['nama_alternatif'] ?>
            </div>
            <div class="winner-score">
                Nilai Preferensi :
                <strong><?= round($best['nilai_preferensi'], 4) ?></strong>
            </div>
        </div>
    </div>
    <?php } ?>

    <!-- TABLE -->
    <div class="card pastel-card shadow ranking-card">
    <div class="card-body">
        <h5 class="text-center mb-3">Urutan Ranking Lengkap</h5>
        <table class="table table-bordered pastel-table ranking-table">
            <thead>
                <tr>
                    <th>Ranking</th>
                    <th>Alternatif</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data as $row){ ?>
                    <tr class="<?= $row['ranking']==1 ? 'rank-1' : '' ?>">
                        <td><?= $row['ranking'] ?></td>
                        <td><?= $row['nama_alternatif'] ?></td>
                        <td><?= round($row['nilai_preferensi'],4) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
