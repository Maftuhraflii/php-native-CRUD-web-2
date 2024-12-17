<?php
// Mulai sesi untuk mengakses data sesi
session_start();

// Include file database.php untuk koneksi ke database
include 'service/database.php';

// Mengecek apakah user sudah login
if (!isset($_SESSION['user']['customer_id'])) {
    // Jika tidak, alihkan ke halaman login
    header("Location: login.php");
    exit();
}

$customer_id = $_SESSION['user']['customer_id']; // ID pelanggan yang sedang login

// Mengecek apakah ada permintaan untuk menghapus pembelian
if (isset($_POST['delete'])) {
    $pembelian_id = $_POST['pembelian_id']; // ID pembelian yang akan dihapus

    // Menghapus pembelian dari tabel Pembelian
    $delete_query = "DELETE FROM Pembelian WHERE pembelian_id = ? AND customer_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("ii", $pembelian_id, $customer_id);
    
    if ($stmt->execute()) {
        echo "Pembelian berhasil dihapus!";
    } else {
        echo "Gagal menghapus pembelian!";
    }
}

if (isset($_POST['bayar'])) {
    // Mengarahkan ke halaman pembayaran.php
    header("Location: pembayaran.php");
    exit(); // Pastikan untuk keluar setelah header untuk menghentikan eksekusi lebih lanjut
}

// Mengambil riwayat pembelian dari database
$query = "SELECT p.pembelian_id, k.nama_kue, p.jumlah, p.total_harga, p.tanggal_pembelian, p.status 
          FROM Pembelian p 
          JOIN kue k ON p.kue_id = k.kue_id 
          WHERE p.customer_id = ? 
          ORDER BY p.tanggal_pembelian DESC"; // Menampilkan riwayat pembelian terbaru
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $customer_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<style>
    <?php include "style/sidebar_user.html" ?>

    /* Container umum untuk konten */
.content {
    max-width: 1100px;
    margin: 40px auto;
    padding: 20px;
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

/* Judul Halaman */
.content h1 {
    font-size: 2.5em;
    color: #AF84BD;
    text-align: center;
    margin-bottom: 40px;
    font-weight: 700;
}

/* Tabel */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd;
    font-size: 1.1em;
}

/* Header Tabel */
table th {
    background-color: #AF84BD;
    color: #fff;
    font-weight: bold;
}

/* Baris Tabel */
table tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tr:nth-child(odd) {
    background-color: #ffffff;
}

/* Hover pada Baris Tabel */
table tr:hover {
    background-color: rgba(158, 106, 167, 0.1); /* Efek hover dengan transparansi */
}

/* Tombol Delete */
button[type="submit"] {
    background-color: #FF4C4C; /* Merah terang untuk tombol delete */
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1em;
    transition: background-color 0.3s ease, transform 0.3s ease;
    font-weight: bold;
}

button[type="submit"]:hover {
    background-color: #FF2D2D; /* Merah lebih terang saat hover */
    transform: scale(1.05); /* Efek zoom saat hover */
}

/* Tombol delete (konfirmasi) */
button[type="submit"]:active {
    transform: scale(1); /* Menghilangkan efek zoom saat tombol ditekan */
}

/* Pesan jika tidak ada pembelian */
p {
    font-size: 1.2em;
    text-align: center;
    color: #666;
    margin-top: 30px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .content {
        padding: 15px;
    }

    table th, table td {
        font-size: 1em;
        padding: 12px;
    }

    .content h1 {
        font-size: 2em;
    }
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pembelian - Toko Kue Kami</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <h2>Panaria Factory</h2>
            </div>
            <ul class="nav">
                <li><a href="dashboard_user.php">Profile</a></li>
                <li><a href="user_pembelian_kue.php">Shop</a></li>
                <li><a href="user_riwayat_pembelian_kue.php">Riwayat Pembelian</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>

        <div class="content">
            <h1>Riwayat Pembelian Anda</h1>

            <?php if ($result->num_rows > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Kue</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Tanggal Pembelian</th>
                            <th>Status</th>
                            <th>Actions</th> <!-- Kolom untuk tombol delete -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['nama_kue']); ?></td>
                                <td><?php echo $row['jumlah']; ?></td>
                                <td>Rp <?php echo number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                <td><?php echo date('d-m-Y', strtotime($row['tanggal_pembelian'])); ?></td>
                                <td><?php echo htmlspecialchars($row['status']); ?></td>
                                <td>
                                    <!-- Form untuk menghapus riwayat pembelian -->
                                    <form method="POST" action="">
                                        <input type="hidden" name="pembelian_id" value="<?php echo $row['pembelian_id']; ?>">
                                        <button type="submit" name="delete" onclick="return confirm('Apakah Anda yakin ingin menghapus pembelian ini?')">Delete</button>
                                        <button type="submit" name="bayar" onclick="return confirm('Apakah Anda yakin ingin menghapus pembelian ini?')">bayar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Anda belum melakukan pembelian.</p>
            <?php endif; ?>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2024 Toko Kue Kami. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
