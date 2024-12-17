<?php
include "service/database.php";  // Pastikan koneksi ke database sudah diatur
session_start();  // Mulai session

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form dan pastikan data tidak kosong
    $nama_kue = isset($_POST['nama_kue']) ? trim($_POST['nama_kue']) : '';
    $harga = isset($_POST['harga']) ? trim($_POST['harga']) : '';
    $stok = isset($_POST['stok']) ? trim($_POST['stok']) : '';
    $deskripsi_kue = isset($_POST['deskripsi_kue']) ? trim($_POST['deskripsi_kue']) : '';

    // Cek apakah ada data yang kosong
    if ($nama_kue == '' || $harga == ''  || $stok == '' || $deskripsi_kue == '') {
        echo "<script>alert('Semua kolom harus diisi!');</script>";
    } else {
        // Persiapkan SQL query untuk mencegah SQL injection
        // Gunakan 's' untuk string dan 'i' untuk integer (harga dan stok adalah angka)
        $stmt = $conn->prepare("INSERT INTO kue (nama_kue, harga, stok, deskripsi_kue) 
                                VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siis", $nama_kue, $harga, $stok, $deskripsi_kue);  // 's' untuk string, 'i' untuk integer

        // Eksekusi query dan periksa apakah berhasil
        if ($stmt->execute()) {
            echo "<script>alert('Kue berhasil ditambahkan!');</script>";
            header("Location: admin_dashboard_data_cake.php");
            exit();
        } else {
            echo "<script>alert('Error: " . $stmt->error . "');</script>";
        }

        // Tutup prepared statement
        $stmt->close();
    }
}
?>
<style>
    /* Mengatur body agar menggunakan latar belakang gambar */
body {
    margin: 0;
    font-family: Arial, sans-serif;
    height: 100vh;
    background: url('img/index_kue_1.jpg') no-repeat center center fixed;
    background-size: cover;
    position: relative;
}

/* Overlay putih dengan sedikit transparansi */
body::before {
    content: "";
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: rgba(122, 121, 121, 0.4); /* Overlay putih tipis */
    z-index: 1;
}

/* Kontainer utama dashboard */
.dashboard-container {
    position: relative;
    z-index: 2; /* Agar konten muncul di depan overlay */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    padding: 20px;
}

/* Kontainer untuk form */
.content {
    background-color: rgba(255, 255, 255, 0.8); /* Background putih transparan */
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
}

/* Judul form */
h1 {
    color: #6a4c9c; /* Warna ungu soft */
    text-align: center;
    margin-bottom: 20px;
}

/* Gaya form-group */
.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: bold;
    color: #6a4c9c; /* Warna ungu soft untuk label */
    margin-bottom: 5px;
}

.form-group input {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ddd;
    font-size: 16px;
    color: #333;
}

/* Tombol tambah */
.tambah-button {
    padding: 12px 24px;
    font-size: 16px;
    color: white;
    background-color: #6a4c9c; /* Warna ungu soft */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s;
    font-weight: bold;
}

.tambah-button:hover {
    background-color: #5a3b88; /* Warna ungu lebih gelap saat hover */
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kue-Admin</title>
</head>
<body>
    <div class="dashboard-container">  
        <!-- Konten Utama -->
        <main class="content">
            <div class="form-container">
                <h1>Tambah Kue Baru Panaria Factory</h1>
                    <form action="admin_tambah_kue.php" method="POST">
                        <div class="form-group">
                            <label for="nama_kue">Nama kue</label>
                                <input type="text" id="nama_kue" name="nama_kue" placeholder="Masukkan nama kue..." required>
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                                <input type="number" id="harga" name="harga" min="500" step="500" required>
                        </div>
                        <div class="form-group">
                            <label for="stok">jumlah Stok kue</label>
                                <input type="number" id="stok" name="stok" min="1" required>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_kue">Deskripsi kue</label>
                                <input type="text" id="deskripsi_kue" name="deskripsi_kue" placeholder="Masukkan deskripsi kue..." required>
                        </div>
                        <button type="submit" class="tambah-button">Tambah</button>
                    </form>
            </div>
        </main>
    </div>
</body>
</html>