<?php 
include "env.php";

$res = [
  "status" => 200,
  "msg" => "",
  "body" => "",
];

$kode = $_GET['kode'];

$s = mysqli_query($koneksi, "DELETE FROM laptop WHERE kode='$kode'");

if ($s){
  $res['status'] = 200;
  $res['msg'] = "Data berhasil dihapus";
  $res['body'] = "";
} else {
  $res['status'] = 400;
  $res['msg'] = "Data gagal dihapus";
  $res['body'] = "";
}

echo json_encode($res);

?>