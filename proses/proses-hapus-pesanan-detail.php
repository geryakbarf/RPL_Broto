<?php
include_once"../functions.php";
if(isset($_GET['id'])){
    $db=dbConnect();
    $id=$_GET['id'];
    $idmenu=$_GET['idMenu'];
    $idpes=$_GET['idpes'];
    $nama=$_GET['nama'];
    $meja=$_GET['meja'];
    $status=$_GET['status'];
    $sql="DELETE FROM detail_pesanan WHERE id_pesanan='$id' AND id_menu='$idmenu'";
    $res=$db->query($sql);
    if($res){
        if($db->affected_rows>0){
            header("Location: ../detail-pesanan.php?idpes=$idpes&nama=$nama&meja=$meja&status=$status");
        }
    }
}

?>
