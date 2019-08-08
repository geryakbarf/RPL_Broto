<?php
include_once"../functions.php";
if(isset($_GET['id'])){
    $db=dbConnect();
    $id=$_GET['id'];
    $idmenu=$_GET['idMenu'];
    $idres = $_GET['idres'];
    $nama = $_GET['nama'];
    $meja = $_GET['meja'];
    $tanggal = $_GET['tanggal'];
    $sql="DELETE FROM detail_pesanan WHERE id_pesanan='$id' AND id_menu='$idmenu'";
    $res=$db->query($sql);
    if($res){
        if($db->affected_rows>0){
            header("Location: ../detail-reservasi.php?idres=$idres&nama=$nama&meja=$meja&tanggal=$tanggal");
        }
    }
}

?>
