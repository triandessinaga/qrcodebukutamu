<?php
session_start();

// Include file koneksi.php untuk menghubungkan ke database
include 'koneksi.php';

// Mengambil data dari tabel "Tamu"
$sql = "SELECT * FROM tamu";
$result = $conn->query($sql);

$data = array();

// Memeriksa hasil query
if ($result->num_rows > 0) {
    // Mendapatkan setiap baris data
    while ($row = $result->fetch_assoc()) {
        // Menambahkan baris data ke dalam array
        $data[] = $row;
    }
}

// Menutup koneksi database
$conn->close();

// Mengirimkan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
