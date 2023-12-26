<?php
include "env.php";

$res = [
<<<<<<< HEAD
  "status" => 200,
  "msg" => "",
  "body" => [
      "data" => [
          "nama" => "",
      ]
  ]
      ];
$kode = $_POST['kode'];
$nama = $_POST['nama'];
$s = mysqli_query($koneksi, "INSERT INTO merek (kode, nama) VALUES ('$kode', '$nama')");

if ($s) {

  $res['status'] = 200;
  $res['msg'] = "Data berhasil diinsert";
  $res['body']="";
} else {
  $res['status'] = 400;
  $res['msg'] = "Gagal membuat merek";
  $res['body']="";
=======
 "status" => 200,
 "msg" => "",
 "body" => [
      "data" => [
          "nama" => "",
      ]
 ]
      ];
$kode = $_POST['kode'];
$nama = $_POST['nama'];
<<<<<<< HEAD
$s = mysqli_query($koneksi, "INSERT INTO merek(kode, nama) VALUES ('$kode', '$nama')");

if ($s) {

    $res['status'] = 200;
    $res['msg'] = "Data berhasil diinsert";
    $res['body'] = "";
   } else {
    $res['status'] = 400;
    $res['msg'] = "Gagal membuat merek";
    $res['body'] = "";
   }
   
   echo json_encode($res);
   ?>

   
=======
$s = mysqli_query($koneksi, "INSERT IGNORE INTO merek(kode, nama) VALUES ('$kode', '$nama')");

if ($s) {

 $res['status'] = 200;
 $res['msg'] = "Data berhasil diinsert";
 $res['body'] = "";
} else {
 $res['status'] = 400;
 $res['msg'] = "Gagal membuat merek";
 $res['body'] = "";
>>>>>>> b57a4f68f29046ac653a5600dc887fd7061ff68b
}

echo json_encode($res);
?>
<<<<<<< HEAD
=======
>>>>>>> 2868379a109a0150b1e34ed766451d1f98531e73
>>>>>>> b57a4f68f29046ac653a5600dc887fd7061ff68b
