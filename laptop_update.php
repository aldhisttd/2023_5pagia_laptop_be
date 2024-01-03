<?php
include 'env.php';

$response = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => [
        ]
    ]
];

if (!$koneksi) {
    $response['status'] = 400;
    $response['msg'] = "data gagal diperbarui";
} else {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $kode_kategori = $_POST['kode_kategori'];
    $kode_merek = $_POST['kode_merek'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES["gambar"]["name"] != "") {
        // ambil nama gambar lama
        $result = mysqli_query($koneksi, "SELECT gambar FROM laptop WHERE kode = '$kode'");
        $data = mysqli_fetch_assoc($result);
        $gambar = $data['gambar'];

        // hapus gambar lama
            unlink("upload/" . $gambar);

        // upload gambar baru
        $temp = explode(".", $_FILES["gambar"]["name"]);
        $namaGambarBaru = md5(date('dmy h:i:s')) . '.' . end($temp);
        $target_file = "upload/" . $namaGambarBaru;
        move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file);

        $response['body']['data']['gambar'] = 'upload/' . $namaGambarBaru;
        mysqli_query($koneksi, "UPDATE laptop SET gambar = 'upload/$namaGambarBaru' WHERE kode = '$kode'");
    }

    $response['status'] = 200;
    $response['msg'] = 'data berhasil diperbarui';
    $response['body']['data']['kode'] = $kode;
    $response['body']['data']['nama'] = $nama;
    $response['body']['data']['kode_kategori'] = $kode_kategori;
    $response['body']['data']['kode_merek'] = $kode_merek;
    $response['body']['data']['harga'] = $harga;
    $response['body']['data']['deskripsi'] = $deskripsi;

    mysqli_query($koneksi, "UPDATE laptop
                            SET kode = '$kode', 
                                nama = '$nama', 
                                kode_kategori = '$kode_kategori',
                                kode_merek = '$kode_merek',
                                harga = '$harga',
                                deskripsi = '$deskripsi'
                            WHERE kode = '$kode'");
}

echo json_encode($response);
?>
