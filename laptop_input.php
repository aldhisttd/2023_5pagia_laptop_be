<?php
include 'env.php';

$kode = $_POST['kode'];
$nama = $_POST['nama'];
$kode_kategori = $_POST['kode_kategori'];
$kode_merek = $_POST['kode_merek'];
$harga = $_POST['harga'];
$deskripsi = $_POST['deskripsi'];

// cek duplikat
$query = mysqli_query($koneksi, "SELECT * FROM laptop WHERE kode = '$kode'");
$row = mysqli_num_rows($query);

if($row == 1){
    http_response_code(400);
    $response = array(
        "status" => 400,
        "msg" => "Proses insert gagal",
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
} else {
    $namaGambarBaru = 'gambar.jpg';
    if (array_key_exists("gambar", $_FILES)) {
        $temp = explode(".", $_FILES["gambar"]["name"]);
        $namaGambarBaru = md5(date('dmy h:i:s')) . '.' . end($temp);
        $target_file = "upload/" . $namaGambarBaru;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);
    }

    mysqli_query($koneksi, "INSERT INTO laptop (kode, nama, gambar, kode_kategori, kode_merek, harga, deskripsi) VALUES ('$kode', '$nama', 'upload/$namaGambarBaru', '$kode_kategori', '$kode_merek', '$harga', '$deskripsi')");

    $response = array(
        "status" => 200,
        "msg" => "Data berhasil di insert",
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
}

echo json_encode($response);
?>