<?php
include 'koneksi.php'; // Menghubungkan ke file koneksi database

// Fungsi untuk menghash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Fungsi untuk memeriksa kecocokan password yang diinput dengan hash password di database
function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}

// Fungsi untuk memeriksa apakah user dengan email tertentu sudah terdaftar
function isUserRegistered($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return ($user !== null);
}

// Fungsi untuk melakukan proses registrasi
function register($email, $username, $password, $role) {
    global $conn;
    $hashedPassword = hashPassword($password);
    $stmt = $conn->prepare("INSERT INTO user (user_email, user_username, user_password, user_role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $username, $hashedPassword, $role);
    $result = $stmt->execute();
    $stmt->close();
    return $result;
}

// Mendapatkan data dari form registrasi
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

// Memeriksa apakah email sudah terdaftar
if (isUserRegistered($email)) {
    echo 'exists';
} else {
    // Melakukan registrasi
    if (register($email, $username, $password, $role)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>
