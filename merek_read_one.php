<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$kode = $_GET['kode'];
$query = mysqli_query($koneksi, "SELECT * FROM merek WHERE kode = '$kode'");

    if ($query) {
        $datamerek = mysqli_fetch_assoc($query);

        if ($datamerek) {
            $response['status'] = 200;
            $response['msg'] = 'success';
            $response['body']['data'] = $datamerek;
        } else {
            $response['status'] = 400;
            $response['msg'] = 'error';
        }
    }

echo json_encode($response);
?>
