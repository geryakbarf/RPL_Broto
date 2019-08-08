<?php
include_once"../functions.php";

if(!isset($_GET["nopem"])){
    $respon["status"]="ERROR";
    $respon["keterangan"]="Parameter Nomor Pembayaran harus ada.";
}
else{
    $db=dbConnect();
    $id=$db->escape_string($_GET['nopem']);
    $sql="SELECT no_pembayaran FROM pembayaran WHERE no_pembayaran='$id'";
    $res=$db->query($sql);
    if(mysqli_num_rows($res)>0){
    $data=$res->fetch_all(MYSQLI_ASSOC);
    foreach ($data as $new){
        $respon["nopem"]=$new['no_pembayaran'];
    }
    $respon["status"]="OK";
    }else
    $respon["status"]="false";
}
echo json_encode($respon);
?>