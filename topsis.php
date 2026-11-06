<?php
session_start();
include "config.php";

/* ===============================
   AMBIL KRITERIA + BOBOT AHP
=================================*/
$kriteria_q = mysqli_query($conn, "
    SELECT k.id_kriteria, k.nama_kriteria, k.sifat, b.bobot
    FROM kriteria k
    JOIN bobot_kriteria b ON k.id_kriteria = b.id_kriteria
    ORDER BY k.id_kriteria ASC
");

$kriteria = [];
$bobot = [];
$sifat = [];

while ($row = mysqli_fetch_assoc($kriteria_q)) {
    $kriteria[] = [
        'id' => $row['id_kriteria'],
        'nama' => $row['nama_kriteria']
    ];

    // ⬅⬅⬅ INI YANG DIPERBAIKI
    $bobot[$row['id_kriteria']] = (float)$row['bobot'];
    $sifat[$row['id_kriteria']] = strtolower(trim($row['sifat']));
}

/* ===============================
   AMBIL ALTERNATIF
=================================*/
$alt_q = mysqli_query($conn, "SELECT * FROM alternatif ORDER BY id_alternatif ASC");
$alternatif = [];

while ($row = mysqli_fetch_assoc($alt_q)) {
    $alternatif[$row['id_alternatif']] = $row['nama_alternatif'];
}

/* ===============================
   AMBIL PENILAIAN
=================================*/
$nilai_q = mysqli_query($conn, "SELECT * FROM penilaian");
$nilai = [];

while ($row = mysqli_fetch_assoc($nilai_q)) {
    $nilai[$row['id_alternatif']][$row['id_kriteria']] = (float)$row['nilai'];
}

/* ===============================
   PROSES TOPSIS
=================================*/
if (isset($_POST['hitung'])) {

    /* === 1. HITUNG PEMBAGI === */
    $pembagi = [];

    foreach ($kriteria as $k) {
        $kid = $k['id'];
        $sum2 = 0;

        foreach ($alternatif as $aid => $a) {
            $sum2 += pow($nilai[$aid][$kid] ?? 0, 2);
        }

        $pembagi[$kid] = sqrt($sum2);
    }

    /* === 2. NORMALISASI === */
    $R = [];

    foreach ($alternatif as $aid => $a) {
        foreach ($kriteria as $k) {
            $kid = $k['id'];
            $R[$aid][$kid] = ($pembagi[$kid] == 0)
                ? 0
                : ($nilai[$aid][$kid] ?? 0) / $pembagi[$kid];
        }
    }

    /* === 3. NORMALISASI TERBOBOT === */
    $V = [];

    foreach ($R as $aid => $r) {
        foreach ($r as $kid => $v) {
            $V[$aid][$kid] = $v * $bobot[$kid];
        }
    }

    /* === 4. SOLUSI IDEAL POSITIF & NEGATIF === */
    $Aplus = [];
    $Aminus = [];

    foreach ($kriteria as $k) {
        $kid = $k['id'];
        $vals = [];

        foreach ($alternatif as $aid => $a) {
            $vals[] = $V[$aid][$kid];
        }

        // ⬅⬅⬅ INI YANG MENENTUKAN RANKING
        if ($sifat[$kid] === "benefit") {
            $Aplus[$kid]  = max($vals);
            $Aminus[$kid] = min($vals);
        } else { // cost
            $Aplus[$kid]  = min($vals);
            $Aminus[$kid] = max($vals);
        }
    }

    /* === 5. JARAK KE SOLUSI IDEAL === */
    $Dplus = [];
    $Dminus = [];

    foreach ($alternatif as $aid => $a) {
        $dp = 0;
        $dm = 0;

        foreach ($kriteria as $k) {
            $kid = $k['id'];
            $dp += pow($V[$aid][$kid] - $Aplus[$kid], 2);
            $dm += pow($V[$aid][$kid] - $Aminus[$kid], 2);
        }

        $Dplus[$aid]  = sqrt($dp);
        $Dminus[$aid] = sqrt($dm);
    }

    /* === 6. NILAI PREFERENSI === */
    $C = [];

    foreach ($alternatif as $aid => $a) {
        $C[$aid] = ($Dplus[$aid] + $Dminus[$aid] == 0)
            ? 0
            : $Dminus[$aid] / ($Dplus[$aid] + $Dminus[$aid]);
    }

    arsort($C);

    /* === 7. SIMPAN HASIL === */
    mysqli_query($conn, "TRUNCATE TABLE hasil_topsis");

    $rank = 1;
    foreach ($C as $aid => $nilai_pref) {
        mysqli_query($conn, "
            INSERT INTO hasil_topsis (id_alternatif, nilai_preferensi, ranking)
            VALUES ('$aid', '$nilai_pref', '$rank')
        ");
        $rank++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perhitungan TOPSIS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="main-wrapper d-flex align-items-start">
    <?php include "layout/sidebar.php"; ?>

    <div class="content-area">
        <h3 class="mb-4 text-center" style="color:#ff4f9a;">Perhitungan TOPSIS</h3>

        <form method="post" class="card pastel-card shadow p-3">
            <button type="submit" name="hitung" class="btn btn-primary">
                Hitung TOPSIS
            </button>
        </form>

        <?php if (isset($C)) { ?>
            <div class="card pastel-card shadow p-3 mt-4">
                <h5>Ranking Alternatif</h5>
                <table class="table table-bordered pastel-table">
                    <thead class="table-light text-center">
                        <tr>
                            <th>Ranking</th>
                            <th>Alternatif</th>
                            <th>Nilai Preferensi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $r = 1; foreach ($C as $aid => $c) { ?>
                            <tr>
                                <td><?= $r++ ?></td>
                                <td><?= $alternatif[$aid] ?></td>
                                <td><?= round($c, 4) ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php } ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
