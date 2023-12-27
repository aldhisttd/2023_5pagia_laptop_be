<?php
include "env.php";

$res = [
    'status' => '',
    'msg' => '',
    'body' => [
        'data' => []
    ]
];

$kode = mysqli_real_escape_string($koneksi, $_REQUEST['kode']);

$d = mysqli_query($koneksi, "SELECT kode, gambar FROM laptop WHERE kode='$kode'");
$dt = mysqli_fetch_array($d);

if ($dt) {
    if (isset($dt['gambar']) && !empty($dt['gambar'])) {
        $gambar = $dt['gambar'];
        unlink('upload/' . $gambar);
    }

    $q = mysqli_query($koneksi, "DELETE FROM laptop WHERE kode='$kode'");
    if ($q) {
        $res['status'] = 200;
        $res['msg'] = "Data berhasil dihapus";
        $res['body']['data']['kode'] = "$kode";
    } 
} else {
    $res['status'] = 400;
    $res['msg'] = "Data gagal dihapus";
    $res['body']['data']['kode'] = "$kode";
}

echo json_encode($res);
?>