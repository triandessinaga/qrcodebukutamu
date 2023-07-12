<?php
// Memulai sesi
session_start();

// Memeriksa apakah pengguna telah login
if (!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])) {
    // Pengguna belum login, alihkan ke halaman login
    header("Location: login.html");
    exit();
}

// Menangkap data sesi yang telah disimpan sebelumnya
$user_id = $_SESSION['user_id'];
$user_email = $_SESSION['user_email'];
$user_role = $_SESSION['user_role'];
$user_username = $_SESSION['user_username'];

// Fungsi untuk memeriksa peran pengguna
function checkUserRole($allowedRoles) {
    global $user_role;
    return in_array($user_role, $allowedRoles);
}

// Cek peran pengguna pada setiap halaman
function authorizeAccess($allowedRoles) {
    if (!checkUserRole($allowedRoles)) {
        // Pengguna tidak memiliki tingkat peran yang diizinkan untuk mengakses halaman ini
        header("Location: denied.php");
        exit();
    }
}

// Periksa akses pada halaman tamu.php
if (basename($_SERVER['PHP_SELF']) === 'tamu.php') {
    // Periksa apakah pengguna memiliki peran tamu
    authorizeAccess(['tamu','admin']);
}
// Periksa akses pada halaman feedback.php
if (basename($_SERVER['PHP_SELF']) === 'feedback.php') {
    // Periksa apakah pengguna memiliki peran tamu
    authorizeAccess(['tamu','admin']);
}
// Periksa akses pada halaman profile.php
if (basename($_SERVER['PHP_SELF']) === 'profile.php') {
    // Periksa apakah pengguna memiliki peran tamu
    authorizeAccess(['tamu','admin']);
}


// Periksa akses pada halaman admin.php
if (basename($_SERVER['PHP_SELF']) === 'admin.php') {
    // Periksa apakah pengguna memiliki peran admin
    authorizeAccess(['admin']);
}
// Periksa akses pada register  admin.php
if (basename($_SERVER['PHP_SELF']) === 'register_admin.php') {
    // Periksa apakah pengguna memiliki peran admin
    authorizeAccess(['admin']);
}

// Periksa akses pada halaman kategori.html
if (basename($_SERVER['PHP_SELF']) === 'kategori.php') {
    // Periksa apakah pengguna memiliki peran admin 
    authorizeAccess(['admin']);
}
