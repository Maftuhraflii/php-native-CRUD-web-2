<?php
include "service/database.php";
session_start();

// Pastikan ID pasien diterima lewat URL
if (!isset($_GET['kue_id'])) {
    die("ID Kue tidak ditemukan.");
}

$kue_id = $_GET['kue_id'];

// Mulai transaksi
$conn->begin_transaction();

try {
    // Query untuk menghapus data di tabel pembelian yang terkait dengan kue
    $delete_kue_query = "DELETE FROM kue WHERE kue_id = ?";
    $stmt1 = $conn->prepare($delete_kue_query);
    $stmt1->bind_param("i", $kue_id);

    if (!$stmt1->execute()) {
        throw new Exception("Gagal menghapus data pembelian.");
    }

    // Jika semua query berhasil, commit transaksi
    $conn->commit();

    echo "<script>alert('Data kue berhasil dihapus!'); window.location.href='admin_dashboard_data_cake.php';</script>";
} catch (Exception $e) {
    // Jika ada error, rollback transaksi
    $conn->rollback();

    echo "Error: " . $e->getMessage();
}
?>

