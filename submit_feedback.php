<?php
session_start();

// Include file koneksi.php untuk menghubungkan ke database
include 'koneksi.php';

// Mendapatkan data dari form pengisian feedback
$tamu_user_id = $_POST['tamu_id']; // ID tamu yang akan diberi feedback
$tamu_feedback = $_POST['tamu_feedback']; // Feedback dari pelanggan

// Cek tamu_user_id yang paling akhir di dalam sistem
$sql = "SELECT * FROM tamu WHERE tamu_user_id = $tamu_user_id ORDER BY tamu_created_at DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // tamu_user_id ditemukan dalam tabel tamu
  $row = $result->fetch_assoc();
  $latest_tamu_id = $row['tamu_id']; // Ambil tamu_id yang paling akhir

  // Lakukan update dengan tamu_id yang paling akhir
  $sql_update = "UPDATE tamu SET tamu_feedback = '$tamu_feedback', tamu_updated_at = CURRENT_TIMESTAMP WHERE tamu_id = $latest_tamu_id";

  if ($conn->query($sql_update) === TRUE) {
    echo "Success"; // Mengirimkan pesan success ke frontend
  } else {
    echo "Terjadi kesalahan saat mengupdate feedback: " . $conn->error;
  }
} else {
  // tamu_user_id tidak ditemukan dalam tabel tamu
  http_response_code(404);
  echo "Data belum ada di sistem. Silakan isi form kunjungan terlebih dahulu.";
}

// Menutup koneksi ke database
$conn->close();
?>
