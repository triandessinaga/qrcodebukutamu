<?php

session_start();

if (!isset($_SESSION['user_email']) || empty($_SESSION['user_email'])) {
    // Pengguna belum login, alihkan ke halaman login
    header("Location: login.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Access Denied</title>
    <!-- Tambahkan SweetAlert CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.css">
</head>
<body>
    <h1>Access Denied</h1>

    <!-- Tambahkan SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>

    <script>
        // Tampilkan pop-up SweetAlert
        Swal.fire({
            icon: 'error',
            title: 'Access Denied',
            text: 'You do not have permission to access this page.',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // Alihkan pengguna ke halaman login
                window.location.href = 'login.html';
            }
        });
    </script>
</body>
</html>
