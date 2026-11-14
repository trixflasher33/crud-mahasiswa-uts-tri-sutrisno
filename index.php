<?php
// File: index.php (Sesuai Materi Bab 5)
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Mahasiswa - Latihan UTS</title>
   <style>
        body { 
            font-family: sans-serif; 
            background: #0f172a; /* Latar belakang utama gelap */
            color: #e2e8f0;      /* Warna teks terang lembut */
            padding: 20px; 
        }
        .card { 
            background: #1e293b; /* Warna kotak kontainer */
            padding: 25px; 
            border-radius: 8px; 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4); 
            max-width: 900px; 
            margin: 0 auto; 
            border: 1px solid #334155;
        }
        h2 { 
            margin-top: 0; 
            color: #f8fafc; 
            border-bottom: 2px solid #334155;
            padding-bottom: 10px;
        }
        .btn-tambah { 
            display: inline-block; 
            background: #3b82f6; 
            color: #ffffff; 
            padding: 10px 16px; 
            border-radius: 4px; 
            text-decoration: none; 
            margin-bottom: 15px; 
            font-weight: bold; 
        }
        .btn-tambah:hover { 
            background: #2563eb; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 10px; 
            border-color: #334155;
        }
        th, td { 
            padding: 12px; 
            border: 1px solid #334155; 
            text-align: left; 
        }
        th { 
            background: #0f172a; 
            color: #94a3b8; 
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }
        /* Zebra Striping versi Dark Mode */
        tr:nth-child(even) { 
            background-color: #263346; 
        }
        tr:hover { 
            background-color: #334155; 
        }
        /* Warna link Edit & Hapus agar kontras di latar gelap */
        td a {
            font-weight: bold;
        }
        td a[href*="edit_data"] {
            color: #60a5fa !important;
        }
        td a[href*="hapus_data"] {
            color: #f87171 !important;
        }
        .empty-msg { 
            text-align: center; 
            color: #94a3b8; 
            font-style: italic; 
            padding: 20px; 
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Daftar Mahasiswa (Latihan UTS)</h2>
        
        <a href="tambah_data.php" class="btn-tambah">+ Tambah Mahasiswa Baru</a>
        
        <table border="1" class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Jurusan</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $pdo = get_shop_db_connection();

                if ($pdo) {
                    try {
                        // Query SELECT dari tabel mahasiswa sesuai Bab 5
                        $sql = "SELECT * FROM mahasiswa ORDER BY id DESC";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        $dataList = $stmt->fetchAll();

                        if (count($dataList) > 0) {
                            $no = 1; // Penomoran otomatis
                            foreach ($dataList as $row) {
                                echo "<tr>";
                                echo "<td>" . $no++ . "</td>";
                                echo "<td>" . htmlspecialchars($row['nim']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['jurusan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['tgl_daftar']) . "</td>";
                               echo "<td>
                                <a href='edit_data.php?id=" . $row['id'] . "' style='color: #2563eb; text-decoration: none;'>Edit</a> | 
                                <a href='hapus_data.php?id=" . $row['id'] . "' onclick=\"return confirm('Yakin ingin menghapus data mahasiswa ini?');\" style='color: #dc2626; text-decoration: none;'>Hapus</a>
                                </td>";
                            }
                        } else {
                            // Skenario Data Kosong (Bab 5)
                            echo "<tr><td colspan='6' class='empty-msg'>Data tidak ditemukan atau belum ada catatan mahasiswa.</td></tr>";
                        }

                    } catch (\PDOException $e) {
                        log_shop_db_error($e);
                        display_shop_error_message();
                    } finally {
                        $pdo = null;
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>