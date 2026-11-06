<?php
session_start();
include "config.php";

$username = $_POST['username'];
$password = $_POST['password']; // misal user isi 'admin'

// Ambil data user
$query = mysqli_query($conn, "SELECT * FROM user WHERE username='$username'");
$data = mysqli_fetch_assoc($query);

// Jika user ditemukan
if ($data) {

    // bikin hash dari password yg ada di DB (misal 'admin')
    $hash = password_hash($data['password'], PASSWORD_DEFAULT);

    // cek apakah input user cocok
    if (password_verify($password, $hash)) {
        $_SESSION['username'] = $username;
        header("Location: data_kriteria.php");
        exit;
    }
}

header("Location: index.php?error=1");
exit;
