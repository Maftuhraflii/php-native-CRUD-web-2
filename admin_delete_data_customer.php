<?php
include "service/database.php";
session_start();

// Pastikan ID pasien diterima lewat URL
if (!isset($_GET['customer_id'])) {
    die("ID customer tidak ditemukan.");
}

$customer_id = $_GET['customer_id'];

// Mulai transaksi
$conn->begin_transaction();

try {
    // Query untuk menghapus data di tabel pembelian yang terkait dengan pasien
    $delete_customer_query = "DELETE FROM customers WHERE customer_id = ?";
    $stmt1 = $conn->prepare($delete_customer_query);
    $stmt1->bind_param("i", $customer_id);

    if (!$stmt1->execute()) {
        throw new Exception("Gagal menghapus data customer.");
    }

    // Jika semua query berhasil, commit transaksi
    $conn->commit();

    echo "<script>alert('Data customer berhasil dihapus!'); window.location.href='admin_dashboard_data_customer.php';</script>";
} catch (Exception $e) {
    // Jika ada error, rollback transaksi
    $conn->rollback();

    echo "Error: " . $e->getMessage();
}
?>

