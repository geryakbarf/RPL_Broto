<?php
include_once"../functions.php";

$respon=array();
if(!isset($_GET["pesanan"])){
    $respon["status"]="ERROR";
    $respon["keterangan"]="Parameter ID Menu harus ada.";
}
else{
    $respon=array();
    $db=dbConnect();
    $id=$db->escape_string($_GET['pesanan']);
    $sql="SELECT menu.nama_menu, detail_pesanan.jumlah, detail_pesanan.total_harga FROM menu JOIN detail_pesanan ON menu.id_menu=detail_pesanan.id_menu WHERE detail_pesanan.id_pesanan='$id' ";
    $res=$db->query($sql);
    $data=$res->fetch_all(MYSQLI_ASSOC);
    $respon['data']=$data;
    $respon["status"]="OK";
}
echo json_encode($respon);
?>


