<?php
    include "service/database.php";

    $register_message = "";

    if(isset($_POST["register"])){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password']; // Mengamankan password
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];

        try{
            $sql = "INSERT INTO customers (name, username, password, gender, email, address, phone) VALUES 
            ('$name', '$username', '$password', '$gender', '$email', '$address', '$phone')";

            if($conn->query($sql)) {
                $register_message = "Pendaftaran berhasil, silakan login";
                header("location: login.php");
            } else {
                $register_message = "Terjadi kesalahan, silakan coba lagi.";
            }
        } catch (mysqli_sql_exception $e) {
            $register_message = "Ada sesuatu yang salah, silakan coba lagi.";
        }
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Toko Kue Kami</title>
    <link rel="stylesheet" href="styles.css">
</head>

<style>

    /* Mengatur tampilan umum */
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

/* Container untuk form register */
.register-container {
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.2); /* Putih krim dengan transparansi */
    backdrop-filter: blur(5px); /* Menambahkan efek blur pada latar belakang */
    padding: 20px;
}

/* Form register */
.register-form {
    background-color: white;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

.register-form h2 {
    color: #6a4c9c; /* Ungu soft */
    font-size: 24px;
    margin-bottom: 20px;
}

/* Style untuk input */
.register-form input,
.register-form textarea {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    box-sizing: border-box;
}

.register-form input:focus,
.register-form textarea:focus {
    outline: none;
    border-color: #6a4c9c; /* Ungu soft saat fokus */
}

/* Style untuk tombol submit */
.register-form button {
    width: 100%;
    padding: 12px;
    background-color: #6a4c9c; /* Ungu soft */
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.register-form button:hover {
    background-color: #8a6fbd; /* Warna ungu terang saat hover */
}

/* Style untuk link */
.register-form p a {
    color: #6a4c9c;
    text-decoration: none;
}

.register-form p a:hover {
    text-decoration: underline;
}

/* Style untuk bagian radio button gender */
.gender {
    padding : 20px;
    font-size: 16px;
}

.gender label {
    margin-right: 0px;
}

/* Style untuk area text */
.register-form textarea {
    height: 100px;
}

/* Mobile responsiveness */
@media screen and (max-width: 600px) {
    .register-form {
        width: 90%;
        padding: 30px;
    }
}


</style>

<body>

    <div class="register-container">
        <div class="register-form">
            <h2>Daftar Akun Anda</h2>
            <i><?= $register_message ?></i>
            <form action="register.php" method="POST">
                <input type="text" name="name" placeholder="Nama Lengkap" required>
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="text" name="phone" placeholder="Nomor Telepon" required>
                <input type="email" name="email" placeholder="Email" required>
                <textarea name="address" placeholder="Address" required></textarea>

                <div class="gender">
                    <label for="male">
                        <input type="radio" id="male" name="gender" value="Laki-laki" required> Laki-laki
                    </label>
                    <label for="female">
                        <input type="radio" id="female" name="gender" value="Perempuan" required> Perempuan
                    </label>
                </div>

                <button type="submit" name="register">Daftar Sekarang</button>
            </form>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </div>
    </div>

</body>
</html>
