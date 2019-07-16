<?php
include_once ("../functions.php");
if (isset($_POST["TblSimpan"])) {
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        //bersihkan data
        $id = $db->escape_string(trim($_POST["id"]));
        $nama = $db->escape_string(trim($_POST["nama"]));
        $harga = $db->escape_string(trim($_POST["harga"]));
        $status = $db->escape_string(trim($_POST["status"]));

        //Mengecek apakah ada nama makanan Yang Sama
        $sql1 = "SELECT * FROM menu WHERE nama_menu='$nama'";
        $res1 = $db->query($sql1);
        if (mysqli_num_rows($res1) > 0) {
            echo "<script>
                            alert('Menu Telah Ada!');
                            </script>";
            header("Location: tambah-menu.php");
        } else {

            //Query Untuk Insert ke DB
            $sql = "INSERT INTO menu(id_menu,nama_menu,harga_menu,status) VALUES ('$id','$nama',$harga,'$status')";
            $res = $db->query($sql);
            if ($res) {
                if ($db->affected_rows > 0) {//Jika Data Berhasil Disimpan
                    header("Location: ../menu.php");
                } else {
                    header("Location: ../tambah-menu.php");
                }
            }else{
                header("Location: ../tambah-menu.php");
            }
        }
    }
} else
    echo "Galat ! Data to Long"

?>