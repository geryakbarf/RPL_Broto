<?php
include_once ("../functions.php");
if (isset($_POST["TblUpdate"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        //bersihkan data
        $id = $db->escape_string(trim($_POST["id"]));
        $nama = $db->escape_string(trim($_POST["nama"]));
        $harga = $db->escape_string(trim($_POST["harga"]));
        $stok = $db->escape_string(trim($_POST["stok"]));
        $satuan = $db->escape_string(trim($_POST["satuan"]));
        $tanggal = $db->escape_string(trim($_POST["tanggal"]));


            //Query Untuk Insert ke DB
            $sql = "UPDATE bahan_baku SET nama_bahan='$nama', Harga='$harga',stok_bahan='$stok',satuan='$satuan',tgl_kadaluarsa='$tanggal' WHERE id_bahan_baku='$id'";
            $res = $db->query($sql);
            if ($res) {
                if ($db->affected_rows > 0) {//Jika Data Berhasil Disimpan
                    header("Location: ../bahan-baku.php?halaman=1");
                } else {
                    header("Location: ../bahan-baku.php?halaman=1");
                }
            }else{
                header("Location: ../bahan-baku.php?halaman=1&error=3");
            }
        }

} else
    header("Location: ../bahan-baku.php?halaman=1&error=4");

?>