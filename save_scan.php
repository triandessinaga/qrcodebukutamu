<?php
include 'koneksi.php'; // Menghubungkan ke file koneksi database

// Mendapatkan data hasil pemindaian dari permintaan POST
$dataString = $_POST['data'];
$dataString = substr($dataString, strpos($dataString, "{"));
$data = json_decode($dataString, true); // Mendekode data JSON menjadi array asosiatif

// Menyimpan data ke tabel tamu
$sql = "INSERT INTO tamu (tamu_user_id, tamu_kategori_id, tamu_nama, tamu_instansi, tamu_telepon, tamu_keperluan, tamu_tujuan)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $data['user_id'], $data['tujuan'], $data['nama'], $data['organisasi'], $data['phone'], $data['keperluan'], $data['kategori_tujuan']);

if ($stmt->execute()) {
    echo json_encode(array('success' => true, 'message' => 'Data berhasil disimpan ke database.'));
} else {
    echo json_encode(array('success' => false, 'message' => 'Terjadi kesalahan saat menyimpan data ke database: ' . $stmt->error));
}

$stmt->close();
$conn->close();
?>
