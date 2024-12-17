<?php
// Mulai sesi untuk mengakses data sesi
session_start();

// Include file database.php untuk koneksi ke database
include 'service/database.php';

// Mengecek apakah form pembelian sudah dikirimkan
if (isset($_POST['buy'])) {
    // Pastikan pengguna sudah login (session sudah ada)
    if (isset($_SESSION['user']['customer_id'])) {
        $kue_id = $_POST['kue_id']; // ID kue yang dibeli
        $customer_id = $_SESSION['user']['customer_id']; // ID pelanggan yang membeli
        $jumlah = $_POST['jumlah']; // Jumlah kue yang dibeli

        // Mengambil data kue dari database
        $stmt = $conn->prepare("SELECT nama_kue, harga FROM kue WHERE kue_id = ?");
        $stmt->bind_param("i", $kue_id);
        $stmt->execute();
        $stmt->bind_result($nama_kue, $harga_kue);
        $stmt->fetch();
        $stmt->close();

        // Menghitung total harga
        $total_harga = $harga_kue * $jumlah;

        // Menambahkan pembelian ke dalam tabel pembelian
        $stmt = $conn->prepare("INSERT INTO Pembelian (customer_id, kue_id, tanggal_pembelian, jumlah, total_harga, status) 
                                VALUES (?, ?, NOW(), ?, ?, 'belum bayar')");
        $stmt->bind_param("iiid", $customer_id, $kue_id, $jumlah, $total_harga);
        if ($stmt->execute()) {
        } else {
            echo "Gagal melakukan pembelian!";
        }
    } else {
        echo "Anda harus login terlebih dahulu.";
    }
}

// Mengambil semua data kue dari database
$query = "SELECT * FROM kue";
$result = $conn->query($query);
?>

<style>
    <?php include "style/sidebar_user.html" ?>

/* Kontainer Produk */
.product-list {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Kartu Produk */
.product-item {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1); /* Bayangan lembut di sekitar kartu */
    transition: all 0.3s ease;
    text-align: center;
    overflow: hidden; /* Menghindari konten yang meluber */
    position: relative;
}

/* Efek hover pada kartu produk */
.product-item:hover {
    transform: translateY(-10px); /* Efek mengambang saat hover */
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15); /* Meningkatkan bayangan saat hover */
}

/* Nama Kue */
.product-item h3 {
    font-size: 1.8em;
    color: #AF84BD; /* Warna ungu untuk nama kue */
    margin-bottom: 15px;
    font-weight: 600;
    text-transform: capitalize;
}

/* Deskripsi Kue */
.product-item p {
    font-size: 1.1em;
    color: #666;
    margin-bottom: 15px;
}

/* Harga */
.product-item p:nth-child(3) {
    font-size: 1.3em;
    font-weight: bold;
    color: #E673A1; /* Warna pink manis untuk harga */
}

/* Stok Kue */
.product-item p:nth-child(4) {
    font-size: 1.2em;
    color: #66CC66; /* Hijau untuk stok yang cukup */
    font-weight: 600;
}

/* Form Beli */
.product-item form {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 10px;
}

/* Input Jumlah */
.product-item input[type="number"] {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 1.1em;
    width: 70%;
    text-align: center;
    margin-bottom: 15px;
    transition: border-color 0.3s ease;
}

/* Fokus Input */
.product-item input[type="number"]:focus {
    border-color: #AF84BD; /* Efek border berwarna ungu saat fokus */
    outline: none;
}

/* Tombol Beli */
.product-item button[type="submit"] {
    background-color: #FF84A5; /* Warna pink manis untuk tombol */
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 10px;
    font-size: 1.1em;
    cursor: pointer;
    width: 100%;
    transition: all 0.3s ease;
    font-weight: bold;
}

/* Tombol Hover */
.product-item button[type="submit"]:hover {
    background-color: #FF4C67; /* Merah muda lebih kuat saat hover */
    transform: translateY(-2px); /* Efek sedikit mengangkat saat hover */
}

/* Tombol aktif (tekan) */
.product-item button[type="submit"]:active {
    transform: translateY(2px); /* Efek menekan tombol */
}

/* Responsif untuk layar kecil */
@media (max-width: 768px) {
    h1 {
        font-size: 2.2em;
    }

    .product-list {
        grid-template-columns: 1fr 1fr;
    }

    .product-item {
        padding: 15px;
    }

    .product-item input[type="number"] {
        width: 80%;
    }
}

@media (max-width: 480px) {
    .product-list {
        grid-template-columns: 1fr;
    }

    .product-item input[type="number"] {
        width: 90%;
    }

    .product-item button[type="submit"] {
        width: 90%;
    }
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop - Toko Kue Kami</title>
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

        <div class="product-list">
            <?php
            // Perulangan untuk menampilkan kue dari database
            while ($row = $result->fetch_assoc()) {
                echo '<div class="product-item">';
                echo '<h3>' . htmlspecialchars($row['nama_kue']) . '</h3>';
                echo '<p>' . htmlspecialchars($row['deskripsi_kue']) . '</p>';
                echo '<p>Harga: Rp ' . number_format($row['harga'], 0, ',', '.') . '</p>';
                echo '<p>Stok: ' . $row['stok'] . '</p>';
                echo '<form method="POST" action="">';
                echo '<input type="hidden" name="kue_id" value="' . $row['kue_id'] . '">';
                echo '<label for="jumlah">Jumlah: </label>';
                echo '<input type="number" name="jumlah" id="jumlah" min="1" max="' . $row['stok'] . '" required>';
                echo '<button type="submit" name="buy" >Beli</button>';
                echo '</form>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    
</body>
</html>
