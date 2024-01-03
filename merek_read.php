<?php
include "env.php";

$response = [
    'status' => '',
    'message' => '',
    'body' => [
        'data' => []
    ]
];

$q = mysqli_query($koneksi, "SELECT * FROM merek");

$datamerek = mysqli_fetch_all($q, MYSQLI_ASSOC);

if ($datamerek) {
    $response['status'] = 200;
    $response['message'] = 'Success';
    $response['body']['data'] = $datamerek;
} else {
    $response['status'] = 400;
    $response['message'] = 'error';
}

echo json_encode($response);
?>