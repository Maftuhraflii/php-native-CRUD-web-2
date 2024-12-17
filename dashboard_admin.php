<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="style.css">
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
<?php include "style/sidebar.html" ?>
    <?php include "style/style_dashboard_admin.html" ?>
    
</style>
<body>
    <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h2>Admin</h2>
            </div>
            <ul class="nav">
                <li><a href="dashboard_admin.php">Dashboard</a></li>
                <li><a href="admin_dashboard_data_cake.php">Cake</a></li>
                <li><a href="admin_dashboard_data_customer.php">Customer</a></li>
                <li><a href="admin_dashboard_data_pembelian.php">Orders</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <div class="header">
                <h1>Welcome, our beautiful Admin...<3..</h1>
                <p>Manage your website with ease</p>
            </div>

            <!-- Profile Section -->
            <div class="profile-section">
                <div class="profile-photo">
                    <img src="img/admin_poto.jpg" alt="Admin Profile">
                </div>
                <div class="profile-details">
                    <h2>Triyanisa</h2>
                    <p>Email: Trianisa@example.com</p>
                    <p>Role: Administrator</p>
                </div>
            </div>

            <p>Trianisa adalah seorang profesional di bidang manajemen sistem informasi dengan pengalaman lebih dari 5 tahun dalam mengelola platform digital dan website. Memiliki ketajaman analitis dan keahlian dalam mengoptimalkan alur kerja, Trianisa selalu berusaha untuk memberikan pengalaman terbaik bagi pengguna dan memastikan bahwa segala aspek teknis berjalan dengan lancar. Dengan latar belakang pendidikan di bidang teknologi informasi, ia berkomitmen untuk selalu mengikuti perkembangan terbaru di dunia teknologi dan memperkenalkan inovasi baru di dalam organisasi.</p>
            <br>
            <p>Sebagai seorang administrator, Trianisa bertanggung jawab untuk mengelola dan menjaga integritas serta keamanan sistem yang digunakan dalam operasional harian. Tugas utamanya meliputi pemantauan kinerja website, memastikan semua fitur berfungsi dengan baik, serta mengoptimalkan pengalaman pengguna agar lebih efisien. Selain itu, Trianisa juga memiliki kemampuan komunikasi yang sangat baik, yang memungkinkannya untuk bekerja sama dengan berbagai tim, baik internal maupun eksternal, untuk mencapai tujuan bersama.</p>
            <br>
            <p>Diluar pekerjaan teknis, Trianisa dikenal sebagai sosok yang penuh semangat, selalu siap membantu rekan-rekan dan memastikan bahwa semua proyek dapat diselesaikan dengan baik dan tepat waktu. Dia percaya bahwa kerja tim yang solid dan komunikasi yang efektif adalah kunci kesuksesan dalam menyelesaikan tantangan apapun. Dengan semangat yang tinggi dan dedikasi yang tak tergoyahkan, Trianisa terus berusaha untuk membuat perbedaan yang signifikan dalam setiap langkah yang diambilnya.</p>
            <!-- Action Buttons -->
            <div class="action-buttons">
                <button onclick="window.open('https://www.instagram.com/__ossa?igsh=MTI1ZHA3bXFldnlycQ==', '_blank')">View Admin Profile</button>
            </div>

            <!-- Footer -->
            <footer>
                <p>&copy; 2024 Admin Dashboard | All Rights Reserved</p>
            </footer>
        </div>
    </div>
</body>
</html>
