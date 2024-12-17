<?php
include "service/database.php";
?>
<style>
/* Reset and General Style */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* General Page Style */
body {
    background: linear-gradient(145deg, #f9f0f8, #fff); /* Soft pastel lavender gradient */
    color: #333;
    height: 100vh;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Header */
.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 50px;
    background-color: #fff; /* White milk */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 10;
}

/* Logo */
.logo img {
    width: 120px;
    transition: transform 0.3s ease;
}

.logo img:hover {
    transform: scale(1.1);
}

/* Navbar */
.navbar {
    display: flex;
    justify-content: center;
    align-items: center;
}

.navbar a {
    color: #9b5de5; /* Soft purple */
    font-weight: 600;
    text-transform: uppercase;
    margin: 0 25px;
    font-size: 18px;
    position: relative;
    padding: 10px 0;
    transition: color 0.3s, transform 0.3s;
}

.navbar a:hover {
    color: #ff80cc; /* Soft pink on hover */
    transform: translateY(-5px);
}

/* Add futuristic underline effect */
.navbar a::before {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    background-color: #ff80cc; /* Soft pink underline */
    left: 50%;
    bottom: 0;
    transition: width 0.3s, left 0.3s;
}

.navbar a:hover::before {
    width: 100%;
    left: 0;
}

/* Navbar background */
.header {
    background: linear-gradient(to right, #f1c6ff, #f8e1f4); /* Soft pink and lavender gradient */
    transition: background 0.3s ease;
}

/* Contact */
.contact a {
    margin-left: 15px;
    font-weight: 600;
    color: #9b5de5; /* Soft purple */
    font-size: 18px;
    transition: color 0.3s;
}

.contact a:hover {
    color: #ff80cc; /* Soft pink */
}

/* Hero Section */
.hero {
    background: url('img/kue.jpg') no-repeat center center/cover;
    height: 60vh;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    color: white;
    position: relative;
    animation: slideUp 1.2s ease-out;
    padding-top: 200px;  /* Menambahkan padding-top untuk memberi ruang */
}

.hero-content {
    opacity: 0;
    animation: fadeIn 1.5s forwards;
}

.hero h1 {
    font-size: 3.5rem;  /* Larger font for a more inviting look */
    margin-bottom: 20px;
    letter-spacing: 1px;
    color:rgb(255, 255, 255);
}

.hero p {
    font-size: 1.5rem;
    margin-bottom: 30px;
    letter-spacing: 1px;
    color: rgb(255, 255, 255, 0.9);
}

/* About Us Section */
.about-us {
    padding: 50px 15%;
    text-align: center;
    background-color: #f9e9f1; /* Soft lavender pink */
    animation: slideDown 1.5s ease-out;
}

.about-content h2 {
    font-size: 2.5rem;
    margin-bottom: 20px;
    color:rgb(0, 0, 0);
}

.about-content p {
    font-size: 1.2rem;
    line-height: 1.5;
    color: #555;
}

/* Products and Services Section */
.products-services {
    background-color: #fff; /* White milk */
    padding: 50px 10%;
    text-align: center;
}

.products-list {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.product-item {
    background-color: #ff80cc; /* Soft pink */
    padding: 25px;
    width: 30%;
    color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.product-item:hover {
    transform: scale(1.05);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.product-item h3 {
    font-size: 1.5rem;
    margin-bottom: 10px;
}

.product-item p {
    font-size: 1rem;
    color: #fefefe;
}

/* Production Process Section */
.production-process {
    padding: 50px 10%;
    background-color: #f9e1f7; /* Soft lavender pink */
    text-align: center;
    animation: slideUp 1.2s ease-out;
}

.production-process h2 {
    margin-bottom: 20px;
    font-size: 2.5rem;
    color:rgb(0, 0, 0);
}

.production-process p {
    font-size: 1.2rem;
    color: #555;
    line-height: 1.8;
}

/* Footer Section */
.footer {
    text-align: center;
    padding: 20px;
    background-color: #fff; /* White milk */
    box-shadow: 0 -4px 6px rgba(0, 0, 0, 0.1);
}

.footer p {
    font-size: 1rem;
    color: #777;
}

/* Animations */
@keyframes slideUp {
    0% {
        transform: translateY(30%);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes slideDown {
    0% {
        transform: translateY(-30%);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}

</style>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panaria Factory</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header Section -->
    <header class="header">
        <div class="logo">
            <img src="img/logo.jpg" alt="Panaria Factory Logo">
        </div>
        <nav class="navbar">
            <a href="index.php">Beranda</a>
            <a href="Login.php">Log in</a>
            <a href="register.php">Register</a>
        </nav>
        <div class="contact">
            <a >📞 +62 822-8209-6161</a>
            <a >📧 panaria.factory@gmail.com</a>
        </div>
    </header>

    <!-- Hero Section (Banner) -->
    <section class="hero">
        <div class="hero-content">
            <h1>Selamat Datang di Panaria Factory</h1>
            <p>"Kualitas dan Inovasi dalam Setiap Produksi"</p>
        </div>
    </section>

    <!-- Tentang Kami Section -->
    <section class="about-us">
        <div class="about-content">
            <h2>Tentang Kami</h2>
            <p>Panaria Factory adalah toko kue yang berdiri dengan tujuan memberikan pengalaman manis dan memuaskan melalui produk kue berkualitas tinggi yang dibuat dengan penuh cinta dan keahlian. Didirikan pada 2024, Panaria Factory telah menjadi pilihan utama bagi para pecinta kue yang mencari rasa otentik, bahan-bahan premium, dan desain yang memukau.</p>
            <p>Kami berkomitmen untuk menyajikan kue-kue yang tidak hanya enak, tetapi juga menggugah selera dengan tampilan yang indah, cocok untuk berbagai kesempatan—mulai dari ulang tahun, pernikahan, acara keluarga, hingga perayaan kecil atau besar.</p>
        </div>
    </section>

    <!-- Produk dan Layanan Section -->
    <section class="products-services">
        <h2>Produk dan Layanan</h2>
        <div class="products-list">
            <div class="product-item">
                <h3>Kue Ulang Tahun Cokelat</h3>
                <p>Menikmati kue ulang tahun yang kaya rasa cokelat dengan lapisan krim lembut dan hiasan dekorasi cantik. Kue ini dibuat dari bahan premium yang pasti membuat perayaan Anda semakin spesial.</p>
            </div>
            <div class="product-item">
                <h3>Kue Puff Pastry Klasik</h3>
                <p>Kue puff pastry renyah yang diisi dengan krim vanila lembut, sempurna sebagai camilan sore atau untuk melengkapi acara spesial. Setiap gigitan memberikan rasa manis yang menggugah selera.</p>
            </div>
            <div class="product-item">
                <h3>Kue Red Velvet</h3>
                <p>Kue red velvet lembut dengan lapisan cream cheese yang kaya dan lezat, cocok untuk acara pernikahan atau ulang tahun. Warna merahnya yang cerah membuatnya menjadi pilihan favorit banyak orang.</p>
            </div>
    </section>

    <!-- Proses Produksi Section -->
    <section class="production-process">
        <h2>Proses Produksi</h2>
        <p>Proses produksi kami menggunakan teknologi terbaru untuk memastikan kualitas terbaik dalam setiap produk yang kami buat. Setiap langkah dijalani dengan ketelitian dan perhatian terhadap detail.</p>
        <p>Kami hanya menggunakan bahan-bahan terbaik yang dipilih dengan teliti untuk memastikan kualitas dan cita rasa yang tak tertandingi. Dari tepung premium, cokelat asli, hingga buah-buahan segar, setiap bahan yang kami pilih berperan dalam menciptakan kue yang sempurna. Kue-kue kami tidak hanya lezat, tetapi juga aman dan sehat untuk dinikmati.</p>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <p>© 2024 Panaria Factory. Semua hak cipta dilindungi.</p>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>

