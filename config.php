<?php
// File: shop_config.php

/* =========================================================================
- 1. KONFIGURASI DATABASE MAHASISWA
- ========================================================================= */
define('DB_HOST', 'localhost');
define('DB_NAME', '254242002'); // Sesuai database NPM mahasiswa
define('DB_USER', 'root');       // Default XAMPP
define('DB_PASS', '');           // Default XAMPP (kosong)
define('DB_DRIVER', 'mysql');

/* =========================================================================
- 2. PENGATURAN PDO (Keamanan & Format Data)
- ========================================================================= */
define('PDO_OPTIONS', [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, 
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       
    PDO::ATTR_EMULATE_PREPARES   => false,                  
]);

/* =========================================================================
- 3. FUNGSI UTAMA KONEKSI
- ========================================================================= */
function get_shop_db_connection() {
    $dsn = DB_DRIVER . ":host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, PDO_OPTIONS);
        return $pdo; 
        
    } catch (\PDOException $e) {
        log_shop_db_error($e);
        display_shop_error_message();
        return null; 
    }
}

/* =========================================================================
- 4. FUNGSI HELPER (Pencatatan Log & Pesan Error)
- ========================================================================= */
function log_shop_db_error(PDOException $exception) {
    // Diarahkan khusus ke folder logs/shop_db_error.log
    $log_file = __DIR__ . '/logs/shop_db_error.log'; 
    $log_dir = dirname($log_file);
    
    if (!is_dir($log_dir)) {
        mkdir($log_dir, 0755, true); 
    }

    $error_message = sprintf(
        "[%s] - Error Code: %d, Message: %s, File: %s, Line: %d\n",
        date('Y-m-d H:i:s'),
        $exception->getCode(),
        $exception->getMessage(),
        $exception->getFile(),
        $exception->getLine()
    );

    error_log($error_message, 3, $log_file);
}

function display_shop_error_message() {
    echo "<div style='color: #7f1d1d; background-color: #fef2f2; border: 1px solid #fecaca; padding: 15px; margin: 20px; text-align: center; border-radius: 6px; font-weight: bold;'>";
    echo "🚨 Mohon maaf, sistem toko online sedang mengalami gangguan teknis. Silakan coba beberapa saat lagi.";
    echo "</div>";
}
?>