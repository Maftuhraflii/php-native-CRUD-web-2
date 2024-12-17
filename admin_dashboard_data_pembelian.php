<?php
include "service/database.php";
session_start(); // Mulai session

// Query untuk mengambil data customers
$query = "SELECT * FROM pembelian";
$result = $conn->query($query);

if (!$result) {
    die("Error mengambil data pembelian: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
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
            <h1>Data Pembelian Panaria Factory</h1>
            
            <!-- Tabel Data Dokter -->
            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px;">
                <thead>
                    <tr>
                        <th>No Pembelian</th>
                        <th>Id Pelanggan</th>
                        <th>tanggal pembelian</th>
                        <th>nama kue</th>
                        <th>jumlah</th>
                        <th>total pembelian</th>
                        <th>status</th>
                        <th>edit</th>
                    </tr>
                </thead>
                <tbody>    
                    <?php
                    // Menampilkan data dokter dari database
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['pembelian_id'] . "</td>";
                        echo "<td>" . $row['customer_id'] . "</td>";
                        echo "<td>" . $row['tanggal_pembelian'] . "</td>";
                        echo "<td>" . $row['kue_id'] . "</td>";
                        echo "<td>" . $row['jumlah'] . "</td>";
                        echo "<td>" . $row['total_harga'] . "</td>";
                        echo "<td>" . $row['status'] . "</td>";
                        echo "<td>
                                <a href='admin_delete_data_pembelian.php?pembelian_id=" . $row['pembelian_id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data pembelian ini?\")'><button>Delete</button></a>
                                <a href='admin_edit_data_pembelian.php?pembelian_id=" . $row['pembelian_id'] . "'><button>confirm</button></a>
                             </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </main>
</div>

    
</body>
</html>