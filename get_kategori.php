<?php
session_start();

// Include file koneksi.php untuk menghubungkan ke database
include 'koneksi.php';

// Query untuk mengambil data tujuan
$sql = "SELECT kategori_id, kategori_tujuan FROM kategori";
$result = $conn->query($sql);

// Buat array untuk menyimpan data tujuan
$tujuan = array();

// Loop melalui hasil query dan tambahkan data ke array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tujuan[] = $row;
    }
}

// Konversi array menjadi format JSON
$tujuan_json = json_encode($tujuan);

// Tampilkan data JSON
echo $tujuan_json;

// Tutup koneksi ke database
$conn->close();
?>
