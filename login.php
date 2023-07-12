<?php
session_start();

include 'koneksi.php'; // Menghubungkan ke file koneksi database

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

// Fungsi untuk memeriksa kecocokan password yang diinput dengan hash password di database
function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}

// Fungsi untuk melakukan proses login
function login($email, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    
    if ($user !== null && verifyPassword($password, $user['user_password'])) {
        return $user; // Mengembalikan data user
    }
    
    return false;
}

// Fungsi untuk memeriksa apakah pengguna sudah login
function isLoggedIn() {
    return isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'];
}

// Mendapatkan data dari form login
$email = $_POST['email'];
$password = $_POST['password'];

// Memeriksa apakah user terdaftar dan melakukan proses login
if (isUserRegistered($email)) {
    $userData = login($email, $password);

    // Mengatur data sesi pengguna setelah berhasil login
    if ($userData) {
        $_SESSION['user_id'] = $userData['user_id']; // Menyimpan user_id ke dalam sesi
        $_SESSION['user_email'] = $email;
        $_SESSION['user_role'] = $userData['user_role'];
        $_SESSION['user_username'] = $userData['user_username']; // Menyimpan user_username ke dalam sesi

        $sessionData = session_encode();

        // Mengirim representasi sesi dalam header
        header("X-Session-Data: " . $sessionData);
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'not_registered';
}
?>
