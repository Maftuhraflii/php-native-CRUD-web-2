<?php
include "service/database.php";
session_start();

// Pastikan ID pembelian diterima lewat URL
if (!isset($_GET['pembelian_id'])) {
    die("ID pembelian tidak ditemukan.");
}

$pembelian_id = $_GET['pembelian_id'];

// Query untuk mengambil data pembelian berdasarkan ID
$query = "SELECT * FROM pembelian WHERE pembelian_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $pembelian_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Pembelian tidak ditemukan.");
}

$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data yang diinputkan dan lakukan update
    $status = $_POST['status'];

    // Update status
    $update_query = "UPDATE pembelian SET status = ? WHERE pembelian_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("si", $status, $pembelian_id); // 's' untuk string, 'i' untuk integer (id)

    if ($update_stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location.href='admin_dashboard_data_pembelian.php';</script>";
    } else {
        echo "Error: " . $update_stmt->error;
    }
}
?>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Arial', sans-serif;
        background-color: #f1f8e9;
        color: #6a1b9a;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    h1 {
        text-align: top;
        color: #6a1b9a;
        font-size: 24px;
        margin-bottom: 30px;
    }

    form {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
        width: 400px;
        text-align: left;
    }

    label {
        font-size: 16px;
        color: #6a1b9a;
        margin-bottom: 8px;
        display: block;
    }

    input[type="text"],
    input[type="time"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0 20px 0;
        border: 2px solid #c8e6c9;
        border-radius: 8px;
        font-size: 16px;
        transition: border 0.3s;
    }

    input[type="text"]:focus,
    input[type="time"]:focus {
        border: 2px solid #6a1b9a;
        outline: none;
    }

    button {
        width: 100%;
        padding: 12px;
        background-color: #7a1b99;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #6a1b9a;
    }

    button:focus {
        outline: none;
    }

    form .form-group {
        margin-bottom: 20px;
    }

    @media (max-width: 600px) {
        form {
            width: 90%;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #6a1b9a;
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 30px;
            margin-top: 0;
            padding-top: 20px;
        }
        
    }
</style>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Data Pembelian Pasien</title>
    </head>
    <body>
        <form method="POST" action="">
            <h1>Update Data Pembelian</h1>
            <label for="status">Status Pembayaran:</label>
                <select id="status" name="status" required>
                    <option value="sudah bayar" <?php echo ($row['status'] == 'sudah bayar') ? 'selected' : ''; ?>>Sudah Bayar</option>
                    <option value="belum bayar" <?php echo ($row['status'] == 'belum bayar') ? 'selected' : ''; ?>>Belum Bayar</option>
                </select>
                <button type="submit">Update</button>
        </form>
    </body>
</html>