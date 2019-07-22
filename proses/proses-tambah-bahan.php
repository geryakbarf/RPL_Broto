<?php
include_once ("../functions.php");
if (isset($_POST["TblSimpan"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        //bersihkan data
        $id = $db->escape_string(trim($_POST["id"]));
        $nama = $db->escape_string(trim($_POST["nama"]));
        $harga = $db->escape_string(trim($_POST["harga"]));
        $stok = $db->escape_string(trim($_POST["stok"]));
        $satuan = $db->escape_string(trim($_POST["satuan"]));
        $tanggal = $db->escape_string(trim($_POST["tanggal"]));

        //Mengecek apakah ada nama makanan Yang Sama
        $sql1 = "SELECT * FROM bahan_baku WHERE nama_bahan='$nama'";
        $res1 = $db->query($sql1);
        if (mysqli_num_rows($res1) > 0) {
            echo "<script>
                            alert('Bahan Baku Telah Ada!');
                            </script>";
            header("Location: ../tambah-bahan-baku.php");
        } else {

            //Query Untuk Insert ke DB
            $sql = "INSERT INTO bahan_baku(id_bahan_baku,nama_bahan,Harga,stok_bahan,satuan,tgl_kadaluarsa) VALUES ('$id','$nama',$harga,'$stok','$satuan','$tanggal')";
            $res = $db->query($sql);
            if ($res) {
                if ($db->affected_rows > 0) {//Jika Data Berhasil Disimpan
                    header("Location: ../bahan-baku.php");
                } else {
                    header("Location: ../tambah-bahan-baku.php");
                }
            }else{
                header("Location: ../tambah-bahan-baku.php");
            }
        }
    }
} else
    echo "Galat ! Data to Long"

?>