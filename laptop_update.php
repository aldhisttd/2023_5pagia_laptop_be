<?php
include 'env.php';

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$kode_kategori = $_POST['kode_kategori'];
$kode_merek = $_POST['kode_merek'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];

// cek apakah data ada
$query = mysqli_query($koneksi, "SELECT * FROM laptop WHERE kode = '$kode'");
$row = mysqli_num_rows($query);

if($row == 1){
    $namaGambarBaru = 'gambar.jpg';
    if (array_key_exists("gambar", $_FILES)) {
        $temp = explode(".", $_FILES["gambar"]["name"]);
        $namaGambarBaru = md5(date('dmy h:i:s')) . '.' . end($temp);
        $target_file = "upload/" . $namaGambarBaru;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
    }

    mysqli_query($koneksi, "UPDATE laptop SET nama = '$nama', gambar = 'upload/$namaGambarBaru', kode_kategori = '$kode_kategori', kode_merek = '$kode_merek', harga = '$harga', deskripsi = '$deskripsi' WHERE kode = '$kode'");

    $response = array(
        "status" => 200,
        "msg" => "Data berhasil di update",
        "body" => array(
            "data" => array(
                "kode" => $kode,
                "nama" => $nama,
                "kode_kategori" => $kode_kategori,
                "kode_merek" => $kode_merek,
                "gambar" => 'upload/'.$namaGambarBaru,
                "harga" => $harga,
                "deskripsi" => $deskripsi
            )
        )
    );
} else {
    http_response_code(400);
    $response = array(
        "status" => 400,
        "msg" => "Proses update gagal, data tidak ditemukan",
        "body" => array(
            "data" => array(
                "kode" => $kode,
                "nama" => $nama,
                "kode_kategori" => $kode_kategori,
                "kode_merek" => $kode_merek,
                "gambar" => array_key_exists("gambar", $_FILES) ? $_FILES["gambar"]["name"] : 'upload/gambar.jpg',
                "harga" => $harga,
                "deskripsi" => $deskripsi
            )
        )
    );
}

echo json_encode($response);
?>