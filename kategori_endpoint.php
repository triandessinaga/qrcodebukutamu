<?php
session_start();

// Include file koneksi.php untuk menghubungkan ke database
include 'koneksi.php';

// Read (Mengambil data kategori dari database)
$sql = "SELECT * FROM kategori";
$result = $conn->query($sql);

$data = array(); // Menampung data kategori

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Create (Menambahkan data kategori ke database)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tujuan = $_POST["tujuan"];

    $sql = "INSERT INTO kategori (kategori_tujuan) VALUES ('$tujuan')";
    if ($conn->query($sql) === TRUE) {
        $response = array("status" => "success", "message" => "Kategori berhasil ditambahkan");
    } else {
        $response = array("status" => "error", "message" => "Gagal menambahkan kategori: " . $conn->error);
    }

    echo json_encode($response);
    exit;
}

// Update (Mengubah data kategori di database)
if ($_SERVER["REQUEST_METHOD"] == "PUT") {
    parse_str(file_get_contents("php://input"), $putParams);
    $kategoriId = $putParams["kategori_id"];
    $tujuan = $putParams["tujuan"];

    $sql = "UPDATE kategori SET kategori_tujuan = '$tujuan' WHERE kategori_id = $kategoriId";
    if ($conn->query($sql) === TRUE) {
        $response = array("status" => "success", "message" => "Kategori berhasil diubah");
    } else {
        $response = array("status" => "error", "message" => "Gagal mengubah kategori: " . $conn->error);
    }

    echo json_encode($response);
    exit;
}

// Delete (Menghapus data kategori dari database)
if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    parse_str(file_get_contents("php://input"), $deleteParams);
    $kategoriId = $deleteParams["kategori_id"];

    $sql = "DELETE FROM kategori WHERE kategori_id = $kategoriId";
    if ($conn->query($sql) === TRUE) {
        $response = array("status" => "success", "message" => "Kategori berhasil dihapus");
    } else {
        $response = array("status" => "error", "message" => "Gagal menghapus kategori: " . $conn->error);
    }

    echo json_encode($response);
    exit;
}

$conn->close();
?>
