<?php
// Include file koneksi.php untuk menghubungkan ke database
include 'koneksi.php';

// Query untuk mengambil data kategori
$sql = "SELECT * FROM kategori";
$result = $conn->query($sql);

// Memasukkan data kategori ke dalam array
$kategori_data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kategori_data[] = $row;
    }
}

// Menutup koneksi ke database
$conn->close();

// Mengembalikan data kategori dalam format JSON
header('Content-Type: application/json');
echo json_encode($kategori_data);
?>
