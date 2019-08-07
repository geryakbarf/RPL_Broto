<?php
include_once"../functions.php";
if(isset($_GET['idbahan'])){
    $db=dbConnect();
    $idBah=$_GET['idbahan'];
    $idBel=$_GET['id'];
    $jumlah=$_GET['jumlah'];
    $sql="DELETE FROM detail_belanja WHERE id_belanja='$idBel' AND id_bahan_baku='$idBah'";
    $res=$db->query($sql);
    if($res){
        if($db->affected_rows>0){
            $sql1="UPDATE bahan_baku SET stok_bahan=stok_bahan-'$jumlah' WHERE id_bahan_baku='$idBah'";
            $sqlbaru="UPDATE data_belanja SET total_biaya=total_biaya-('$jumlah'*(SELECT Harga FROM bahan_baku WHERE id_bahan_baku='$idBah'))";
            $db->query($sql1);
            $db->query($sqlbaru);
            header("Location: ../tambah-belanja.php");
        }
    }
}

?>
