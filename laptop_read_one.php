<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$kode = $_REQUEST['kode'];
$query = mysqli_query($koneksi, "SELECT * FROM laptop WHERE kode = '$kode'");
$laptopData= mysqli_fetch_assoc($query);

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
            'status' => 400,
            'msg' => 'error',
            'body' => [
                'data' => []
            ]
        ];
    }
echo json_encode($response);
?>