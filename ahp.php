<?php
session_start();
include "config.php";

/* ======================
   AMBIL KRITERIA
====================== */
$q = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");
$kriteria = [];
while ($r = mysqli_fetch_assoc($q)) {
    $kriteria[] = $r;
}
$n = count($kriteria);

/* ======================
   MATRIX DEFAULT
====================== */
$matrix = [];
$qm = mysqli_query($conn, "SELECT * FROM matrix_ahp");

if (mysqli_num_rows($qm) > 0) {
    while ($r = mysqli_fetch_assoc($qm)) {
        $i = array_search($r['id_kriteria_i'], array_column($kriteria, 'id_kriteria'));
        $j = array_search($r['id_kriteria_j'], array_column($kriteria, 'id_kriteria'));
        $matrix[$i][$j] = $r['nilai'];
    }
} else {
    // default awal
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
            $matrix[$i][$j] = 1;
        }
    }
}



/* ======================
   PROSES HITUNG
====================== */
$bobot = [];

if (isset($_POST['hitung'])) {

    // ambil input
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {
            $matrix[$i][$j] = $_POST['nilai'][$i][$j];
        }
    }

        // ======================
    // SIMPAN MATRIX KE DB
    // ======================

    // hapus data lama
    mysqli_query($conn, "DELETE FROM matrix_ahp");

    // simpan data baru
    for ($i = 0; $i < $n; $i++) {
        for ($j = 0; $j < $n; $j++) {

            $id_i = $kriteria[$i]['id_kriteria'];
            $id_j = $kriteria[$j]['id_kriteria'];
            $nilai = $matrix[$i][$j];

            mysqli_query($conn, "
                INSERT INTO matrix_ahp (id_kriteria_i, id_kriteria_j, nilai)
                VALUES ('$id_i', '$id_j', '$nilai')
            ");
        }
    }


    // simpan ke session
    $_SESSION['matrix_ahp'] = $matrix;


    // jumlah kolom
    $sumKolom = [];
    for ($j = 0; $j < $n; $j++) {
        $sumKolom[$j] = 0;
        for ($i = 0; $i < $n; $i++) {
            $sumKolom[$j] += $matrix[$i][$j];
        }
    }

    // normalisasi & bobot
    for ($i = 0; $i < $n; $i++) {
        $bobot[$i] = 0;
        for ($j = 0; $j < $n; $j++) {
            $bobot[$i] += $matrix[$i][$j] / $sumKolom[$j];
        }
        $bobot[$i] /= $n;

        // simpan ke DB
        $id = $kriteria[$i]['id_kriteria'];
        $b = $bobot[$i];

        mysqli_query($conn, "
            INSERT INTO bobot_kriteria (id_kriteria, bobot)
            VALUES ('$id','$b')
            ON DUPLICATE KEY UPDATE bobot='$b'
        ");
    }
}

/* ======================
   LOAD BOBOT TERAKHIR
====================== */
$qb = mysqli_query($conn, "SELECT * FROM bobot_kriteria");
$bobot_db = [];
while ($r = mysqli_fetch_assoc($qb)) {
    $bobot_db[$r['id_kriteria']] = $r['bobot'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Perhitungan AHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="main-wrapper d-flex">
<?php include "layout/sidebar.php"; ?>

<div class="content-area">

<h3 class="text-center mb-4" style="color:#ff4f9a;">Perhitungan AHP</h3>

<form method="post">
<div class="card pastel-card shadow">
<div class="card-body table-responsive">

<table class="table table-bordered text-center">
<thead>
<tr>
    <th>Kriteria</th>
    <?php foreach ($kriteria as $k) { ?>
        <th><?= $k['kode_kriteria'] ?></th>
    <?php } ?>
</tr>
</thead>
<tbody>

<?php for ($i = 0; $i < $n; $i++) { ?>
<tr>
    <th><?= $kriteria[$i]['kode_kriteria'] ?></th>
    <?php for ($j = 0; $j < $n; $j++) { ?>
        <td>
            <input type="number" step="any"
                   name="nilai[<?= $i ?>][<?= $j ?>]"
                   value="<?= $matrix[$i][$j] ?>"
                   class="form-control text-center"
                   <?= $i == $j ? "readonly" : "" ?>>
        </td>
    <?php } ?>
</tr>
<?php } ?>

</tbody>
</table>

<button type="submit" name="hitung" class="btn btn-primary w-100">
    Hitung Bobot
</button>

</div>
</div>
</form>

<!-- HASIL BOBOT -->
<div class="card pastel-card shadow mt-4">
<div class="card-body">

<h5>Bobot Kriteria</h5>

<table class="table table-bordered text-center">
<tr>
    <th>Kriteria</th>
    <th>Bobot</th>
</tr>

<?php foreach ($kriteria as $k) { ?>
<tr>
    <td><?= $k['nama_kriteria'] ?></td>
    <td>
        <?= isset($bobot_db[$k['id_kriteria']])
            ? round($bobot_db[$k['id_kriteria']], 6)
            : '-' ?>
    </td>
</tr>
<?php } ?>

</table>

</div>
</div>

</div>
</div>

</body>
</html>