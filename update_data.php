<?php
// File: update_data.php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id      = trim($_POST['id']);
    $nim     = trim($_POST['nim']);
    $nama    = trim($_POST['nama']);
    $jurusan = trim($_POST['jurusan']);

    if (empty($id) || empty($nim) || empty($nama) || empty($jurusan)) {
        echo "<script>alert('Semua kolom wajib diisi!'); window.history.back();</script>";
        exit;
    }

    $pdo = get_shop_db_connection();

    if ($pdo) {
        try {
            // Query UPDATE dengan Prepared Statement
            $sql = "UPDATE mahasiswa SET nim = ?, nama = ?, jurusan = ? WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $execute = $stmt->execute([$nim, $nama, $jurusan, $id]);

            if ($execute) {
                echo "<script>alert('Data mahasiswa berhasil diperbarui!'); window.location='index.php';</script>";
            }
        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<script>alert('Gagal! NIM sudah digunakan mahasiswa lain.'); window.history.back();</script>";
            } else {
                log_shop_db_error($e);
                display_shop_error_message();
            }
        } finally {
            $pdo = null;
        }
    }
} else {
    header("Location: index.php");
    exit;
}
?>