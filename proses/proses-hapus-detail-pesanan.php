<?php
include_once"../functions.php";
if(isset($_GET['id'])){
    $db=dbConnect();
    $id=$_GET['id'];
    $idmenu=$_GET['idMenu'];
    $sql="DELETE FROM detail_pesanan WHERE id_pesanan='$id' AND id_menu='$idmenu'";
    $res=$db->query($sql);
    if($res){
        if($db->affected_rows>0){
            header("Location: ../tambah-pesanan.php");
        }
    }
}

?>
