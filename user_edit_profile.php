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

// Koneksi ke database
include 'service/database.php';

// Periksa apakah form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data yang diinputkan
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    
    // Ambil ID pengguna dari session
    $customer_id = $user['customer_id'];

    // Update data pengguna di database
    $update_query = "UPDATE customers SET name = ?, email = ?, address = ?, phone = ?, gender = ? WHERE customer_id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param("sssssi", $name, $email, $address, $phone, $gender, $customer_id);
    
    if ($stmt->execute()) {
        // Update data di session
        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['address'] = $address;
        $_SESSION['user']['phone'] = $phone;
        $_SESSION['user']['gender'] = $gender;
        echo "Profil berhasil diperbarui!";
        header("Location: dashboard_user.php");
    } else {
        echo "Gagal memperbarui profil.";
    }
}
?>
<style>
    /* Reset dasar dan styling umum */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body */
body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4; /* Latar belakang netral yang lembut */
    color: #333;
    line-height: 1.6;
}

/* Container untuk konten */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

/* Konten Profil */
.profile-content {
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 40px;
    max-width: 600px;
    width: 100%;
}

.profile-content h2 {
    text-align: center;
    font-size: 2.2em;
    color: #AF84BD; /* Warna ungu yang elegan */
    margin-bottom: 30px;
    font-weight: 700;
}

/* Formulir Edit Profil */
form {
    display: grid;
    grid-template-columns: 1fr;
    gap: 20px;
}

/* Label */
label {
    font-size: 1.1em;
    color: #666;
    font-weight: 600;
}

/* Input, Select dan Textarea */
input[type="text"], input[type="email"], select, textarea {
    padding: 12px;
    border: 2px solid #ddd;
    border-radius: 8px;
    font-size: 1.1em;
    background-color: #f9f9f9;
    color: #333;
    width: 100%;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus, input[type="email"]:focus, select:focus, textarea:focus {
    border-color: #AF84BD; /* Warna ungu saat input fokus */
    outline: none;
}

textarea {
    resize: vertical;
    height: 120px;
}

/* Tombol Perbarui Profil */
button[type="submit"] {
    background-color: #AF84BD; /* Warna ungu untuk tombol */
    color: white;
    padding: 15px 25px;
    border: none;
    border-radius: 8px;
    font-size: 1.2em;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
    font-weight: bold;
    width: 100%;
    margin-top: 20px;
}

button[type="submit"]:hover {
    background-color: #8f69a3; /* Warna ungu lebih gelap saat hover */
    transform: scale(1.05); /* Efek zoom saat hover */
}

button[type="submit"]:active {
    transform: scale(1); /* Efek zoom hilang saat ditekan */
}

/* Footer */
footer {
    text-align: center;
    background-color: #2d2d2d;
    color: #fff;
    padding: 15px 0;
    position: relative;
    bottom: 0;
    width: 100%;
    margin-top: 40px;
}

footer p {
    font-size: 1.1em;
}

/* Responsif untuk layar kecil */
@media (max-width: 768px) {
    .container {
        padding: 10px;
    }

    .profile-content {
        padding: 30px;
    }

    .profile-content h2 {
        font-size: 2em;
    }

    button[type="submit"] {
        font-size: 1.1em;
    }
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profil - Toko Kue Kami</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container">

        <div class="profile-content">
            <h2>Edit Profil Anda</h2>
            <form method="POST" action="">
                <label for="name">Nama:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>

                <label for="address">Alamat:</label>
                <textarea id="address" name="address" required><?php echo htmlspecialchars($user['address']); ?></textarea>

                <label for="phone">Nomor Telepon:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['phone']); ?>" required>

                <label for="gender">Jenis Kelamin:</label>
                <select id="gender" name="gender" required>
                    <option value="L" <?php echo $user['gender'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                    <option value="P" <?php echo $user['gender'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                </select>

                <button type="submit">Perbarui Profil</button>
            </form>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Toko Kue Kami. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
