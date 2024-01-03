<?php
include "env.php";

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$kode = $_POST['kode'];
$nama = $_POST['nama'];

$s = mysqli_query($koneksi, "INSERT INTO kategori (kode, nama) VALUES ('$kode', '$nama')");


if ($s) {
    $res['status'] = 200;
    $res['msg'] = "Data berhasil diinsert";
    $res['body']['data']['kode'] = $kode;
    $res['body']['data']['nama'] = $nama;
} else {
    $res['status'] = 400;
    $res['msg'] = "Gagal membuat kategori";
    $res['body']['data']['kode'] = $kode;
    $res['body']['data']['nama'] = $nama;
}

echo json_encode($res);
?>