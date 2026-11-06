<?php
session_start();
include "config.php";

/* ===========================
   AMBIL DATA Kriteria
=========================== */
$data = mysqli_query($conn, "SELECT * FROM kriteria ORDER BY id_kriteria ASC");

/* ===========================
   MODE EDIT 
=========================== */
$editMode = false;
$editData = null;

if (isset($_GET['edit'])) {
    $editMode = true;
    $idEdit = $_GET['edit'];

    $qEdit = mysqli_query($conn, "SELECT * FROM kriteria WHERE id_kriteria='$idEdit'");
    $editData = mysqli_fetch_assoc($qEdit);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Kriteria</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="main-wrapper d-flex align-items-start">

<?php include "layout/sidebar.php"; ?>

<div class="content-area">

    <h3 class="mb-4 text-center" style="color:#ff4f9a;">Data Kriteria</h3>

    <!-- ALERT -->
    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-success">
            Data kriteria berhasil diperbarui
        </div>
    <?php } ?>

    <a href="#" class="btn btn-primary mb-3"
       data-bs-toggle="modal" data-bs-target="#modalTambah">
        + Tambah Kriteria
    </a>

    <div class="card pastel-card shadow">
        <div class="card-body">
            <table class="table table-bordered pastel-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kriteria</th>
                        <th>Nama Kriteria</th>
                        <th>Sifat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) { ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['kode_kriteria'] ?></td>
                            <td><?= $row['nama_kriteria'] ?></td>
                            <td><?= $row['sifat'] ?></td>
                            <td>
                                <a href="data_kriteria.php?edit=<?= $row['id_kriteria'] ?>"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <a href="hapus_kriteria.php?id=<?= $row['id_kriteria'] ?>"
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('Hapus kriteria ini?')">
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

<!-- =======================
     MODAL EDIT (POPUP)
======================= -->
<?php if ($editMode && $editData) { ?>
<div class="modal fade" id="modalEditPage" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <form method="post" action="edit_kriteria.php">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kriteria</h5>
                    <a href="data_kriteria.php" class="btn-close"></a>
                </div>

                <div class="modal-body">
                    <input type="hidden" name="id_kriteria"
                           value="<?= $editData['id_kriteria'] ?>">

                    <input type="hidden" name="kode_kriteria"
                           value="<?= $editData['kode_kriteria'] ?>">

                    <div class="mb-3">
                        <label>Kode Kriteria</label>
                        <input type="text"
                               class="form-control"
                               value="<?= $editData['kode_kriteria'] ?>"
                               readonly>
                    </div>

                    <div class="mb-3">
                        <label>Nama Kriteria</label>
                        <input type="text"
                               name="nama_kriteria"
                               class="form-control"
                               value="<?= $editData['nama_kriteria'] ?>"
                               required>
                    </div>

                    <div class="mb-3">
                        <label>Sifat</label>
                        <select name="sifat" class="form-control" required>
                            <option value="Benefit" <?= $editData['sifat']=="Benefit"?"selected":"" ?>>
                                Benefit
                            </option>
                            <option value="Cost" <?= $editData['sifat']=="Cost"?"selected":"" ?>>
                                Cost
                            </option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <a href="data_kriteria.php" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</div>
<?php } ?>

<!-- =======================
     MODAL TAMBAH
======================= -->
<div class="modal fade" id="modalTambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="tambah_kriteria.php">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kriteria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label>Kode Kriteria</label>
                        <input type="text" name="kode_kriteria" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Nama Kriteria</label>
                        <input type="text" name="nama_kriteria" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Sifat</label>
                        <select name="sifat" class="form-control" required>
                            <option value="">--Pilih--</option>
                            <option value="Benefit">Benefit</option>
                            <option value="Cost">Cost</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- AUTO SHOW MODAL EDIT -->
<script>
<?php if ($editMode) { ?>
    const modalEdit = new bootstrap.Modal(
        document.getElementById('modalEditPage')
    );
    modalEdit.show();
<?php } ?>
</script>

</body>
</html>
