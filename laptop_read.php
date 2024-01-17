<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

if (!isset($koneksi)) {

    $response['status'] = 400;
    $response['msg'] = 'error';
    $response['body']['data'] = [];
} else {

    $q = "
        SELECT A.*, B.nama as nama_kategori, C.nama as nama_merek
        FROM laptop A, kategori B, merek C 
        WHERE A.kode_kategori = B.kode 
        AND A.kode_merek = C.kode;
    ";
    $result = mysqli_query($koneksi, $q);

    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $response['status'] = 200;
    $response['msg'] = 'success';
    $response['body']['data'] = $row;
}

echo json_encode($response);
