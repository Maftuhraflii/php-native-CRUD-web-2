<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Pembayaran</title>
    <style>
       /* Umum */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f8f8f8;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #333;
}

/* Container Utama */
.container {
    background-color: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 600px;
    text-align: center;
    width: 100%;
}

/* Judul Halaman */
h1 {
    font-size: 24px;
    color: #4CAF50;
    margin-bottom: 20px;
    font-weight: bold;
}

/* Deskripsi Pembayaran */
p {
    font-size: 16px;
    margin-bottom: 30px;
    color: #555;
}

/* QR Code Container */
.qr-container {
    margin-bottom: 30px;
}

.qr-container img {
    width: 200px; /* Sesuaikan ukuran QR code */
    height: auto;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Tombol Konfirmasi Pembayaran */
.btn-pay {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 15px 25px;
    font-size: 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.btn-pay:hover {
    background-color: #45a049;
}

/* Responsif untuk perangkat kecil */
@media (max-width: 768px) {
    .container {
        padding: 20px;
    }

    .qr-container img {
        width: 150px; /* Ukuran QR Code lebih kecil untuk perangkat kecil */
    }

    h1 {
        font-size: 20px;
    }

    p {
        font-size: 14px;
    }
}


    </style>
</head>
<body>
    <div class="container">
        <h1>Halaman Pembayaran</h1>
        <p>Silakan lakukan pembayaran dengan QRIS sesuai dengan jumlah yang tertera di bawah ini.</p>

        <!-- QR Code Pembayaran -->
        <div class="qr-container">
            <!-- Ganti URL ini dengan link QRIS yang sesuai atau generate QR dari layanan pembayaran -->
            <img src="img/qris.jpg" alt="QRIS Pembayaran">
        </div>

        <!-- Tombol Pembayaran -->
        <button class="btn-pay" onclick="showNotification()">Konfirmasi Pembayaran</button>

<script>
function showNotification() {
    // Menampilkan alert dengan pesan
    alert("Terima kasih, Anda sudah membayar.");

    // Setelah notifikasi ditutup, mengarahkan ke dashboard.php
    window.location.href = 'user_riwayat_pembelian_kue.php';
}
</script>

    </div>
</body>
</html>
