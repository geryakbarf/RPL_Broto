<?php
include_once"../functions.php";
if(isset($_GET['idBah'])){
    $db=dbConnect();
    $idBah=$_GET['idBah'];
    $idKeb=$_GET['idKeb'];
    $jumlah=$_GET['jumlah'];
    $sql="DELETE FROM detail_kebutuhan WHERE id_kebutuhan='$idKeb' AND id_bahan_baku='$idBah'";
    $res=$db->query($sql);
    if($res){
        if($db->affected_rows>0){
            $sql1="UPDATE bahan_baku SET stok_bahan=stok_bahan+'$jumlah' WHERE id_bahan_baku='$idBah'";
            $db->query($sql1);
            header("Location: ../tambah-kebutuhan.php");
        }
    }
}

?>
