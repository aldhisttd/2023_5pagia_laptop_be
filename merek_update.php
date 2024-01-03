<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];


$kode = $_POST['kode'];
$nama = $_POST['nama'];

$query = mysqli_query($koneksi, "UPDATE merek SET nama='$nama' WHERE kode='$kode'");

    if ($query) {
        $response['status'] = 200;
        $response['msg'] = 'Data berhasil diperbarui';
        $response['body']['data']['kode'] = $kode;
        $response['body']['data']['nama'] = $nama;
    } else {
        $response['status'] = 400;
        $response['msg'] = 'Data gagal diperbarui';
    }


echo json_encode($response);
?>