<?php
include('koneksi.php'); // File koneksi database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $user_username = $_POST['user_username'];
    $user_password = $_POST['user_password'];

    // Update data pengguna ke dalam database
    if (!empty($user_username)) {
        $sql = "UPDATE user SET user_username = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $user_username, $user_id);
        $result_username = $stmt->execute();
    } else {
        $result_username = true; // Jika username tidak diubah, tetap menganggapnya berhasil
    }

    if (!empty($user_password)) {
        // Membuat hash password baru jika password diisi
        $user_password = password_hash($user_password, PASSWORD_DEFAULT);

        $sql = "UPDATE user SET user_password = ? WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('si', $user_password, $user_id);
        $result_password = $stmt->execute();
    } else {
        $result_password = true; // Jika password tidak diubah, tetap menganggapnya berhasil
    }

    // Cek hasil update untuk username dan password
    if ($result_username && $result_password) {
        // Jika berhasil diupdate
        echo json_encode(['status' => 'success']);
    } else {
        // Jika terjadi kesalahan
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }
}
?>
