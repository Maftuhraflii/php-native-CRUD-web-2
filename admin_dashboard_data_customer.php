<?php
include "service/database.php";
session_start(); // Mulai session

// Query untuk mengambil data customers
$query = "SELECT * FROM customers";
$result = $conn->query($query);

if (!$result) {
    die("Error mengambil data obat: " . $conn->error);
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
            <h1>Data Customer Panaria Factory</h1>
            
            <!-- Tabel Data Dokter -->
            <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; margin-top: 20px;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Customer</th>
                        <th>username</th>
                        <th>password</th>
                        <th>jenis kelamin</th>
                        <th>No telephon</th>
                        <th>Email </th>
                        <th>Alamat </th>
                        <th>Edit </th>
                    </tr>
                </thead>
                <tbody> 
                    <?php
                    // Menampilkan data dokter dari database
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['customer_id'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['password'] . "</td>";
                        echo "<td>" . $row['gender'] . "</td>";
                        echo "<td>" . $row['phone'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['address'] . "</td>";
                        echo "<td>
                                <a href='admin_delete_data_customer.php?customer_id=" . $row['customer_id'] . "' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data obat ini?\")'><button>Delete</button></a>
                             </td>";
                        echo "</tr>";
                    }?>
                </tbody>
            </table>
        </main>
</div>

</body>
</html>