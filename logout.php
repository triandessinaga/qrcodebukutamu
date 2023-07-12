<?php
session_start(); // Mulai sesi

// Hapus semua variabel sesi
$_SESSION = array();

// Hapus sesi
session_destroy();

// Alihkan pengguna ke halaman login
header("Location: login.html");
exit();
?>
