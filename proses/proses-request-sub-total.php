<?php
include_once"../functions.php";

$respon=array();
if(!isset($_GET["pesanan"])){
    $respon["status"]="ERROR";
    $respon["keterangan"]="Parameter ID Menu harus ada.";
}
else{
    $db=dbConnect();
    $id=$db->escape_string($_GET['pesanan']);
    $sql="SELECT SUM(total_harga)as total FROM detail_pesanan WHERE id_pesanan='$id' ";
    $res=$db->query($sql);
    $data=$res->fetch_all(MYSQLI_ASSOC);
    foreach ($data as $new){
        $respon["total"]=$new['total'];
    }
    $respon["status"]="OK";
}
echo json_encode($respon);
?>


