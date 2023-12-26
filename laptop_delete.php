<?php
include "env.php";
$res = [
    "status" => 200,
    "msg" => "",
    "body" => "",
];

$kode = mysqli_real_escape_string($koneksi, $_REQUEST['kode']);

$d = mysqli_query($koneksi, "SELECT kode, gambar FROM laptop WHERE kode='$kode'");
$dt = mysqli_fetch_array($d);

if ($dt) {
    if (isset($dt['gambar']) && !empty($dt['gambar'])) {
        $gambar = $dt['gambar'];
        unlink('gambar/' . $gambar);
    }

    $q = mysqli_query($koneksi, "DELETE FROM laptop WHERE kode='$kode'");
    if ($q) {
        $res['status'] = 200;
        $res['msg'] = "Data berhasil dihapus";
        $res['body'] = "";
    } else {
        $res['status'] = 404;
        $res['msg'] = "Data tidak ditemukan";
        $res['body'] = "";
    }
} else {
    $res['status'] = 404;
    $res['msg'] = "Data tidak ditemukan";
    $res['body'] = "";
}

echo json_encode($res);
?>