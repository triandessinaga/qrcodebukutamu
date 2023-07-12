<?php
session_start();

// Include file koneksi.php untuk menghubungkan ke database
include 'koneksi.php';

// Fungsi untuk memeriksa apakah pengguna dengan email tertentu sudah terdaftar
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

// Fungsi untuk mendaftarkan pengguna ke dalam database
function registerUser($email, $password, $username, $userRole) {
    global $conn;

    // Hash password jika diperlukan
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan data pengguna ke dalam tabel 'user'
    $stmt = $conn->prepare("INSERT INTO user (user_email, user_password, user_username, user_role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $email, $hashedPassword, $username, $userRole);
    $stmt->execute();
    $stmt->close();
}

// Memeriksa apakah pengguna terdaftar di sistem berdasarkan email
function login($email, $password) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $stmt->close();

    if ($user !== null && password_verify($password, $user['user_password'])) {
        return $user['user_role']; // Mengembalikan peran pengguna
    }

    return false;
}

// Mendapatkan credential dari Google Sign-In
$credential = $_POST['credential'];

// Memeriksa apakah credential dari Google Sign-In tersedia
if (!empty($credential)) {
    $client_id = '389353906753-cr1041o0vcba6k6qq5s2s789ql1fk676.apps.googleusercontent.com';
    // $client_id = '389353906753-46f16902hp1mb6fkp5a3d9v3k7hvjtf4.apps.googleusercontent.com';

    // Memeriksa apakah credential valid
    $payload = null;
    $curl = curl_init('https://oauth2.googleapis.com/tokeninfo?id_token=' . $credential);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    $payload = json_decode($response, true);
    
    if ($payload && $payload['aud'] == $client_id) {
        $email = $payload['email'];
        $password = ''; // Isi dengan password yang sesuai dengan logika aplikasi
        $username = $payload['name'];

        // Memeriksa apakah pengguna terdaftar di sistem
        if (isUserRegistered($email)) {
            $userRole = login($email, $password);

            // Mengatur data sesi pengguna setelah berhasil login
            if ($userRole) {
                $stmt = $conn->prepare("SELECT user_id FROM user WHERE user_email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                $stmt->close();
                
                $_SESSION['user_id'] = $user['user_id']; // Menyimpan user_id ke dalam sesi
                $_SESSION['user_email'] = $email;
                $_SESSION['user_role'] = $userRole;
                $_SESSION['user_username'] = $username; // Menyimpan user_username ke dalam sesi

                if ($userRole === 'admin') {
                    $sessionData = session_encode();
        
                    // Mengirim representasi sesi dalam header
                    header("X-Session-Data: " . $sessionData);
                    echo 'success';
                } else if ($userRole === 'tamu') {
                    $sessionData = session_encode();
        
                    // Mengirim representasi sesi dalam header
                    header("X-Session-Data: " . $sessionData);
                    echo 'tamu';
                }
            } else {
                echo 'error';
            }
        } else {
            // Jika pengguna tidak terdaftar, melakukan pendaftaran otomatis dengan peran tamu
            $userRole = 'tamu';
            registerUser($email, $password, $username, $userRole);

            // Mendapatkan user_id baru yang telah didaftarkan
            $stmt = $conn->prepare("SELECT user_id FROM user WHERE user_email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            $stmt->close();

            // Mengatur data sesi pengguna setelah berhasil mendaftar
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['user_email'] = $email;
            $_SESSION['user_role'] = $userRole;
            $_SESSION['user_username'] = $username;

            echo 'tamu';
        }
    } else {
        echo 'error';
    }
}
?>
