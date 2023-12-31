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
$kode_kategori = $_POST['kode_kategori'];
$kode_merek = $_POST['kode_merek'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];

// Proses upload file
$temp = explode(".", $_FILES["gambar"]["name"]);
$namaGambarBaru = md5(date('dmy h:i:s')) . '.' . end($temp);
$target_file = "upload/" . $namaGambarBaru;
move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

// Set nama file gambar
$gambar = 'upload/'.$namaGambarBaru;

// cek duplikat
$query = mysqli_query($koneksi, "SELECT * FROM laptop WHERE kode = '$kode'");
$row = mysqli_num_rows($query);

if($row == 1){
    $response['status'] = 400;
    $response['msg'] = 'Proses insert gagal';
} else {

    $response['status'] = 200;
    $response['msg'] = 'Data berhasil di insert';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['kode_kategori'] = $kode_kategori;
    $response['body']['data']['kode_merek'] = $kode_merek;
    $response['body']['data']['gambar'] = $gambar;
    $response['body']['data']['harga'] = $harga;
    $response['body']['data']['deskripsi'] = $deskripsi;

    mysqli_query($koneksi, "INSERT INTO laptop (kode, nama, kode_kategori, kode_merek, gambar, harga, deskripsi) VALUES ('$kode', '$nama', '$kode_kategori', '$kode_merek', '$gambar', '$harga', '$deskripsi')");
}

echo json_encode($response);
?>