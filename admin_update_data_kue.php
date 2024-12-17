<?php
include "service/database.php";
session_start();

// Pastikan ID dokter diterima lewat URL
if (!isset($_GET['kue_id'])) {
    die("ID kue tidak ditemukan.");
}

$kue_id = $_GET['kue_id'];

// Query untuk mengambil data dokter berdasarkan obat_id
$query = "SELECT * FROM kue WHERE kue_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $kue_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Obat tidak ditemukan.");
}

$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data yang diinputkan dan lakukan update
    $nama_kue = $_POST['nama_kue'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    $update_query = "UPDATE kue SET nama_kue = ?, harga = ?, stok = ? WHERE kue_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sdii", $nama_kue, $harga, $stok, $kue_id);

    if ($update_stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='admin_dashboard_data_cake.php';</script>";
    } else {
        echo "Error: " . $update_stmt->error;
    }
}
?>
<style>
    /* General Styles */
body {
    font-family: 'Arial', sans-serif;
    background-image: url('img/index_kue_3.jpg'); /* Ganti dengan path gambar Anda */
    background-size: cover;
    background-position: center;
    background-attachment: fixed; /* Membuat gambar tetap saat scroll */
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Form Styling */
form {
    background-color: rgba(255, 255, 255, 0.9); /* Warna putih dengan transparansi */
    width: 40%;
    margin: 50px auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    text-align: center;
}

/* Heading */
h1 {
    font-size: 32px;
    color: #9c27b0; /* Soft Purple */
    margin-bottom: 20px;
}

/* Input Styling */
label {
    font-size: 16px;
    color: #555;
    display: block;
    margin-bottom: 5px;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 2px solid #ddd;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
}

input[type="text"]:focus {
    border-color: #9c27b0; /* Soft Purple */
    outline: none;
}

/* Button Styling */
button {
    padding: 12px 30px;
    font-size: 16px;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    background-color: #9c27b0; /* Soft Purple */
    color: white;
    transition: all 0.3s ease;
    width: 100%;
    margin-top: 20px;
}

button:hover {
    background-color: #7b1fa2; /* Darker purple on hover */
}

/* Responsive Design */
@media (max-width: 768px) {
    form {
        width: 80%; /* Lebar form menyesuaikan layar kecil */
    }

    h1 {
        font-size: 28px;
    }
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data Penjualan Kue</title>
</head>
<body>
    <form method="POST" action="">
    <h1>Update Data Penjualan Kue</h1>
        <label for="nama_kue">Nama kue:</label>
        <input type="text" id="nama_kue" name="nama_kue" value="<?= $row['nama_kue'] ?>" required><br><br>

        <label for="harga">Harga kue:</label>
        <input type="text" id="harga" name="harga" value="<?= $row['harga'] ?>" required><br><br>

        <label for="stok">Stok kue:</label>
        <input type="text" id="stok" name="stok" value="<?= $row['stok'] ?>" required><br><br>

        <button type="submit">Update</button>
    </form>
</body>
</html>