<?php
// File: hapus_data.php
require_once 'config.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $pdo = get_shop_db_connection();

    if ($pdo) {
        try {
            // Query DELETE dengan Prepared Statement
            $sql = "DELETE FROM mahasiswa WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $execute = $stmt->execute([$id]);

            if ($execute) {
                echo "<script>alert('Data mahasiswa berhasil dihapus!'); window.location='index.php';</script>";
            }
        } catch (\PDOException $e) {
            log_shop_db_error($e);
            display_shop_error_message();
        } finally {
            $pdo = null;
        }
    }
} else {
    header("Location: index.php");
    exit;
}
?>