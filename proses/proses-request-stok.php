<?php
include_once"../functions.php";

$respon=array();
if(!isset($_GET["idBahan"])){
    $respon["status"]="ERROR";
    $respon["keterangan"]="Parameter ID Menu harus ada.";
}
else{
    $db=dbConnect();
    $id=$db->escape_string($_GET['idBahan']);
    $sql="SELECT stok_bahan, nama_bahan FROM bahan_baku WHERE id_bahan_baku='$id'";
    $res=$db->query($sql);
    $data=$res->fetch_all(MYSQLI_ASSOC);
    foreach ($data as $new){
        $respon["stok"]=$new['stok_bahan'];
        $respon['nama']=$new['nama_bahan'];
    }
    $respon["status"]="OK";


}
echo json_encode($respon);
?>


