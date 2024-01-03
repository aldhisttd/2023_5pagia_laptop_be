<?php

// Database connection (similar to insert_kategori.php)
include "env.php";

if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}

// Check if the 'id' parameter is provided in the URL
if (isset($_GET['kode'])) {
    $kode = $_GET['kode'];

    // Use prepared statement to prevent SQL injection
    $sql = "SELECT * FROM kategori WHERE kode = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $kode);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
        echo json_encode(array("status" => "200", "message" => "success", "data" => $data));
    } else {
        echo json_encode(array("status" => "400", "message" => "error"));
    }

    $stmt->close();
} else {
    echo json_encode(array("status" => "400", "message" => "error"));
}

$koneksi->close();
?>
