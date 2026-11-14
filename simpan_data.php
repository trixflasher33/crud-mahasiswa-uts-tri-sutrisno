<?php
// File: simpan_data.php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nim     = trim($_POST['nim']);
    $nama    = trim($_POST['nama']);
    $jurusan = trim($_POST['jurusan']);

    // Validasi server-side sederhana
    if (empty($nim) || empty($nama) || empty($jurusan)) {
        echo "<script>alert('Semua kolom wajib diisi!'); window.history.back();</script>";
        exit;
    }

    $pdo = get_shop_db_connection();

    if ($pdo) {
        try {
            // Query INSERT khusus tabel mahasiswa
            $sql = "INSERT INTO mahasiswa (nim, nama, jurusan) VALUES (?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            
            $execute = $stmt->execute([$nim, $nama, $jurusan]);

            if ($execute) {
                echo "<script>alert('Data mahasiswa berhasil disimpan!'); window.location='index.php';</script>";
            }

        } catch (\PDOException $e) {
            if ($e->getCode() == 23000) {
                echo "<script>alert('Gagal! NIM sudah terdaftar.'); window.history.back();</script>";
            } else {
                log_shop_db_error($e);
                display_shop_error_message();
            }
        } finally {
            $pdo = null;
        }
    }
} else {
    header("Location: tambah_data.php");
    exit;
}
?>