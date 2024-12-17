<?php
// Mulai sesi untuk memeriksa status login
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user'])) {
    // Jika tidak login, redirect ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil data pengguna dari session
$user = $_SESSION['user'];
?>
<style>
<?php include "style/sidebar_user.html" ?>
/* Konten Profil */
.profile-content {
    margin-left: 250px;
    padding: 40px;
    flex-grow: 1;
    background-color: #ffffff;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    max-width: 900px;
    margin: 40px auto;
    transition: all 0.3s ease;
}

.profile-content:hover {
    transform: scale(1.02); /* Efek zoom saat hover */
}

.profile-content h2 {
    font-size: 2.4em;
    color: #AF84BD;
    margin-bottom: 30px;
    text-align: center;
    font-weight: bold;
}

.profile-content p {
    font-size: 1.2em;
    margin: 15px 0;
    color: #333333;
}

.profile-content strong {
    color: #AF84BD; /* Warna ungu muda untuk label */
}

/* Profil Info Box */
.profile-info {
    background-color: #ffffff;
    border-radius: 8px;
    padding: 25px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 30px;
}

.profile-info p {
    font-size: 1.1em;
    color: #333333;
}

.profile-info strong {
    color: #AF84BD;
    font-weight: bold;
}

/* Tombol Aksi (Logout dan Edit Profil) */
.profile-actions {
    display: flex;
    justify-content: center;
    gap: 25px;
}

.profile-actions button {
    font-size: 1.1em;
    padding: 15px 30px;
    border: none;
    border-radius: 50px; /* Membuat tombol lebih bulat */
    cursor: pointer;
    transition: all 0.3s ease;
    font-weight: bold;
    text-transform: uppercase;
}

.logout-btn {
    background-color:rgb(149, 174, 219); /* Emas untuk tombol Logout */
    color: white;
    width: 180px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.logout-btn:hover {
    background-color: #FFC107; /* Emas lebih terang saat hover */
    transform: translateY(-5px); /* Efek elevasi */
}

.edit-btn {
    background-color: #ffffff;
    color: #AF84BD;
    border: 2px solid #AF84BD;
    width: 180px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.edit-btn:hover {
    background-color: #AF84BD;
    color: white;
    transform: translateY(-5px);
}

/* Footer */
footer {
    text-align: center;
    background-color: #AF84BD;
    color: white;
    padding: 15px;
    font-size: 0.9em;
    margin-top: 30px;
    position: relative;
    box-shadow: 0 -2px 12px rgba(0, 0, 0, 0.1);
}

footer p {
    margin: 0;
}

</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Toko Kue Kami</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <div class="logo">
                <h2>Hii,<?php echo $user['name']; ?></h2>
            </div>
            <ul class="nav">
                <li><a href="dashboard_user.php">Profile</a></li>
                <li><a href="user_pembelian_kue.php">Shop</a></li>
                <li><a href="user_riwayat_pembelian_kue.php">Riwayat Pembelian</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    
        <div class="profile-content">
            <h2>Profil Pengguna</h2>
            <p><strong>Nama:</strong> <?php echo htmlspecialchars($user['name']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
            <p><strong>Alamat:</strong> <?php echo htmlspecialchars($user['address']); ?></p>
            <p><strong>Nomor Telepon:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
            <p><strong>Jenis Kelamin:</strong> <?php echo htmlspecialchars($user['gender']); ?></p>
            
            <div class="profile-actions">
                <!-- Tombol untuk logout -->
                <a href="user_riwayat_pembelian_kue.php"><button class="logout-btn">riwayat pembelian</button></a>
                <!-- Tombol untuk mengubah profil jika diperlukan -->
                <a href="user_edit_profile.php"><button class="edit-btn">Edit Profil</button></a>
            </div>
        </div>
    </div>
    
    <footer>
        <p>&copy; 2024 Toko Kue Kami. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
