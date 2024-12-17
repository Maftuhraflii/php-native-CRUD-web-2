<?php
include "service/database.php";
session_start();

$login_message = ""; // Pesan login (error/success)

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Gunakan prepared statement untuk keamanan
    $stmt = $conn->prepare("SELECT * FROM customers WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        // Jika password disimpan dalam bentuk plaintext di database
        if ($password == $data['password']) {
            // Password valid
            $_SESSION['user'] = [
                'customer_id' => $data['customer_id'],
                'name' => $data['name'],
                'address' => $data['address'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'gender' => $data['gender'],
            ];

            // Contoh saat pengguna login
            $_SESSION['customer'] = [
                'customer_id' => $data['customer_id'],
                'username' => $data['username'],
            ];

            // Redirect berdasarkan role pengguna
            if ($data['role'] === 'admin') {
                header("Location: dashboard_admin.php");
            } elseif ($data['role'] === 'customer') {
                header("Location: dashboard_user.php");
            } else {
                $login_message = "Role tidak valid.";
            }
            exit();
        } else {
            $login_message = "Username atau password salah.";
        }
    } else {
        $login_message = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HALAMAN LOGIN</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<style>

    /* Gaya umum halaman */
body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    background-image: url('img/background_login.jpg'); /* Ganti dengan path gambar latar belakang Anda */
    background-size: cover; /* Mengisi seluruh layar */
    background-position: center; /* Posisi gambar di tengah */
    background-repeat: no-repeat;
    height: 100vh; /* Full height */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Wadah form login */
.login-container {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.3); /* Putih krim dengan transparansi */
    backdrop-filter: blur(5px); /* Menambahkan efek blur pada latar belakang */
    padding: 20px;
}

/* Form login */
.login-form {
    background-color: #fff; /* Putih cerah */
    padding: 40px;
    border-radius: 10px; /* Membuat sudut membulat */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Memberikan bayangan halus pada form */
    width: 100%;
    max-width: 400px; /* Lebar maksimal form */
    text-align: center;
}

/* Judul Form */
.login-form h3 {
    color: #6a4c9c; /* Warna ungu soft */
    font-size: 2em;
    margin-bottom: 20px;
}

/* Pesan error */
.error-message {
    color: #ff0000; /* Warna merah untuk pesan error */
    font-size: 1.2em;
    margin-bottom: 10px;
}

/* Input fields */
.login-form input {
    width: 100%;
    padding: 15px;
    margin: 10px 0;
    border-radius: 5px;
    border: 1px solid #ddd;
    font-size: 1em;
    transition: border-color 0.3s ease;
}

/* Efek saat input difokuskan */
.login-form input:focus {
    outline: none;
    border-color: #6a4c9c; /* Warna ungu soft saat fokus */
}

/* Tombol login */
.login-form button {
    width: 100%;
    padding: 15px;
    background-color: #6a4c9c; /* Ungu soft */
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1.2em;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Efek saat tombol dihover */
.login-form button:hover {
    background-color: #8a6fbd; /* Warna ungu lebih terang saat hover */
}

/* Tautan register */
.login-form a {
    display: block;
    margin-top: 20px;
    font-size: 1em;
    color: #6a4c9c; /* Warna ungu soft untuk link */
    text-decoration: none;
}

/* Efek saat tautan dihover */
.login-form a:hover {
    text-decoration: underline;
}

/* Tampilan footer */
footer {
    background-color: #6a4c9c; /* Warna ungu soft */
    color: white;
    text-align: center;
    padding: 10px 0;
    position: fixed;
    width: 100%;
    bottom: 0;
}

<?php include "style/button_home.html" ?>

</style>

<body>
    <div class="login-container">
        <div class="login-form">
            <h3>MASUK AKUN</h3>
                <?php if (!empty($login_message)) { echo "<p class='error-message'>$login_message</p>"; } ?>
                    <form action="login.php" method="POST">
                                <input type="text" placeholder="Masukkan username Anda..." name="username" required />
                                <input type="password" placeholder="Masukkan password Anda..." name="password" required />
                            <button type="submit" name="login">Log in</button>
                    </form>
            <a href="register.php">Register</a>
        </div>
    </div>

    <div class="logout-container">
        <a href="index.php">
            <button class="logout-btn">Home</button>
        </a>
    </div>
    <footer>
        <p>&copy; 2024 Toko Kue Kami. Semua Hak Dilindungi.</p>
    </footer>
</body>
</html>
