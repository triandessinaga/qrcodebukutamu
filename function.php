<?php
// Fungsi untuk menghash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

// Fungsi untuk memeriksa kecocokan password yang diinput dengan hash password di database
function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}

// Fungsi untuk mendapatkan data user berdasarkan email
function getUserByEmail($email) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user;
}

// Fungsi untuk mendapatkan data user berdasarkan user ID
function getUserByID($userID) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();
    return $user;
}

// Fungsi untuk memeriksa apakah user dengan email tertentu sudah terdaftar
function isUserRegistered($email) {
    $user = getUserByEmail($email);
    return ($user !== null);
}

// Fungsi untuk melakukan proses login
function login($email, $password) {
    $user = getUserByEmail($email);
    if ($user !== null) {
        if (verifyPassword($password, $user['user_password'])) {
            return $user;
        }
    }
    return null;
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
?>
