<?php include_once("../functions.php"); ?>
<?php
if (isset($_POST["TblSimpan"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        //bersihkan data
        $nama = $db->escape_string(trim($_POST["nama"]));
        $harga = $db->escape_string(trim($_POST["harga"]));
        $status = $db->escape_string(trim($_POST["status"]));

        //Mengecek apakah ada nama makanan Yang Sama
        $sql1 = "SELECT * FROM menu WHERE nama_menu='$nama'";
        $res1 = $db->query($sql1);
        if(mysqli_num_rows($res1)>0){
            echo "Masa di restoran ada nama makanan yang sama banget :(";
        } else {

            //Query Untuk Insert ke DB
            $sql = "INSERT INTO menu(nama_menu,harga_menu,status) VALUES ('$nama',$harga,'$status')";
            $res = $db->query($sql);
            if ($res) {
                if ($db->affected_rows > 0) {//Jika Data Berhasil Disimpan
                    echo "Data Berhasil Disimpan";
                }else{
                    echo "Data Gagal Disimpan :(";
                }
            }
        }
    }
}

?>
