<?php
include "env.php";

if (isset($_REQUEST['kode'])) {
    $kode = $_REQUEST['kode'];

    $query = "SELECT * FROM laptop WHERE kode='$kode'";
    $result = mysqli_query($koneksi, $query);
    $laptopData = mysqli_fetch_assoc($result);

    if ($laptopData) {
        $response = [
            'status' => 200,
            'msg' => 'success',
            'body' => [
                'data' => [
                    'kode' => $laptopData['kode'],
                    'nama' => $laptopData['nama'],
                    'kode_kategori' => $laptopData['kode_kategori'],
                    'kode_merek' => $laptopData['kode_merek'],
                    'gambar' => $laptopData['gambar'],
                    'harga' => $laptopData['harga'],
                    'deskripsi' => $laptopData['deskripsi']
                ]
            ]
        ];
    } else {
        $response = [
            'status' => 404,
            'msg' => 'not found',
            'body' => [
                'data' => []
            ]
        ];
    }
}

echo json_encode($response);
?>
