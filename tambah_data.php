<?php
// File: tambah_data.php
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Mahasiswa - Latihan UTS</title>
    <style>
        body { 
            font-family: sans-serif; 
            background: #0f172a; 
            color: #e2e8f0; 
            padding: 20px; 
        }
        .card { 
            background: #1e293b; 
            padding: 25px; 
            border-radius: 8px; 
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4); 
            max-width: 500px; 
            margin: 0 auto; 
            border: 1px solid #334155;
        }
        h2 { 
            margin-top: 0; 
            color: #f8fafc; 
            border-bottom: 2px solid #334155; 
            padding-bottom: 10px; 
        }
        .form-group { 
            margin-bottom: 15px; 
        }
        label { 
            display: block; 
            margin-bottom: 6px; 
            font-weight: bold; 
            color: #cbd5e1; 
        }
        input[type="text"], select { 
            width: 100%; 
            padding: 10px; 
            background: #0f172a; 
            color: #f8fafc; 
            border: 1px solid #475569; 
            border-radius: 4px; 
            box-sizing: border-box; 
        }
        input[type="text"]:focus, select:focus {
            outline: none;
            border-color: #3b82f6;
        }
        button { 
            background: #3b82f6; 
            color: white; 
            border: none; 
            padding: 12px 20px; 
            border-radius: 4px; 
            cursor: pointer; 
            font-weight: bold; 
            width: 100%; 
            margin-top: 5px;
        }
        button:hover { 
            background: #2563eb; 
        }
        .back-link { 
            display: inline-block; 
            margin-top: 15px; 
            color: #60a5fa; 
            text-decoration: none; 
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Form Input Data Mahasiswa</h2>
        
        <form action="simpan_data.php" method="POST">
            <div class="form-group">
                <label>NIM:</label>
                <input type="text" name="nim" required placeholder="Masukkan NIM...">
            </div>

            <div class="form-group">
                <label>Nama Lengkap:</label>
                <input type="text" name="nama" required placeholder="Masukkan Nama Sesuai KTP...">
            </div>

           <div class="form-group">
    <label>Jurusan:</label>
    <select name="jurusan" required>
        <option value="">-- Pilih Jurusan --</option>
        <option value="Teknik Informatika">Teknik Informatika</option>
        <option value="Sistem Informasi">Sistem Informasi</option>
        <option value="Teknik Mesin">Teknik Mesin</option>
        <option value="Psikologi">Psikologi</option>
        <option value="Kedokteran">Kedokteran</option>
        <option value="Kebidanan">Kebidanan</option>
    </select>
</div>

            <button type="submit">Simpan Data Mahasiswa</button>
        </form>

        <a href="index.php" class="back-link">← Kembali ke Daftar Mahasiswa</a>
    </div>
</body>
</html>