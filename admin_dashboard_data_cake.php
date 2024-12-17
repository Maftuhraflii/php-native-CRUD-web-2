<?php
include "service/database.php";
session_start(); // Mulai session

// Query untuk mengambil data customers
$query = "SELECT * FROM kue";
$result = $conn->query($query);

if (!$result) {
    die("Error mengambil data kue: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data-kue-Admin</title>
</head>
<style>
    
/* Reset some default styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styles */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f0f0f5; /* Soft light grayish background */
    color: #444; /* Darker text color for better readability */
}
<?php include "style/style_dashboard_admin.html" ?>
<?php include "style/sidebar.html" ?>
<?php include "style/tabel.html" ?>

.btn-tambah {
    padding: 12px 24px;
    font-size: 16px;
    color: white;
    background-color: #4CAF50; /* Warna hijau */
    text-decoration: none; /* Menghilangkan garis bawah */
    border: none;
    border-radius: 5px;
    cursor: pointer;
    position: absolute;
    top: 70px; /* Jarak dari atas */
    right: 150px; /* Jarak dari kanan */
    transition: background-color 0.3s;
    text-align: center;
}

.btn-tambah:hover {
    background-color: #45a049; /* Warna hijau lebih gelap saat hover */
}
</style>
<body>
<div class="container">
        <!-- Sidebar Dashboard -->
        <div class="sidebar">
            <div class="logo">
                <h2>Admin</h2>
            </div>
            <ul class="nav">
                <li><a href="dashboard_admin.php">Dashboard</a></li>
                <li><a href="admin_dashboard_data_cake.php">Cake</a></li>
                <li><a href="admin_dashboard_data_customer.php">Customer</a></li>
                <li><a href="admin_dashboard_data_pembelian.php">Orders</a></li>
                <li><a href="login.php">Log Out</a></li>
            </ul>
        </div>

        <!-- Konten Utama -->
        <main class="content">
            <h1>Data Kue Panaria Factory</h1>
            
            <!-- Tabel Data Dokter -->
            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kue</th>
                        <th>harga</th>
                        <th>stok</th>
                        <th>deskripsi kue</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody> 
                    <?php
                    // Menampilkan data dokter dari database
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['kue_id'] . "</td>";
                        echo "<td>" . $row['nama_kue'] . "</td>";
                        echo "<td>" . $row['harga'] . "</td>";
                        echo "<td>" . $row['stok'] . "</td>";
                        echo "<td>" . $row['deskripsi_kue'] . "</td>";                       
                        echo "<td>
                                <a href='admin_update_data_kue.php?kue_id=" . $row['kue_id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin memperbarui data kue ini?\")'><button>update</button></a>
                                <a href='admin_delete_data_kue.php?kue_id=" . $row['kue_id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data kue ini?\")'><button>Delete</button></a>
                             </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>
</div>

<a href="admin_tambah_kue.php" class="btn-tambah">Tambah Kue</a>

</body>
</html>