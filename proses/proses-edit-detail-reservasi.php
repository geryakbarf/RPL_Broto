<?php
include_once"../functions.php";
$db=dbConnect();
if($db->connect_errno==0){
    if(isset($_POST['TblDetail'])){
        $idpes=$_POST['idpes'];
        $idres=$_POST['idres'];
        $tanggal=$_POST['tanggal'];
        $nama=$_POST['nama'];
        $meja=$_POST['meja'];
        $status=$_POST['status'];
        $menu=$_POST['menu'];
        $jumlah=$_POST['jumlah'];
        //Eksekusi Query Validasi
        $sql="SELECT * FROM detail_pesanan WHERE id_menu='$menu' AND id_pesanan='$idpes'";
        $res=$db->query($sql);
        if(mysqli_num_rows($res)>0){
            $query="UPDATE detail_pesanan SET jumlah=jumlah+'$jumlah', total_harga=total_harga+('$jumlah'*(SELECT harga_menu FROM menu WHERE id_menu='$menu'))
                        WHERE id_menu='$menu' AND id_pesanan='$idpes'";
            $db->query($query);
            if($db->affected_rows>0){
                header("Location: ../detail-reservasi.php?idres=$idres&nama=$nama&meja=$meja&tanggal=$tanggal");
            }else
                echo "ERROR1";
        }else{
            $sqlku="INSERT INTO detail_pesanan(id_pesanan,id_menu,jumlah,total_harga) VALUES ('$idpes','$menu','$jumlah','$jumlah'*(SELECT harga_menu FROM menu WHERE id_menu='$menu'))";
            $db->query($sqlku);
            if($db->affected_rows>0){
                header("Location: ../detail-reservasi.php?idres=$idres&nama=$nama&meja=$meja&tanggal=$tanggal");
            }else
            echo "ERROR2";//endif
        }
        echo "ERROR3";//endif
    }else
    echo "ERROR1";//endif
}//endif
?>