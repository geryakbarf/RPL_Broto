<?php
include_once"../functions.php";

if(!isset($_GET["pesanan"])){
    $respon["status"]="ERROR";
    $respon["keterangan"]="Parameter ID Menu harus ada.";
}
else{
    $db=dbConnect();
    $id=$db->escape_string($_GET['pesanan']);
    $sql="SELECT tanggal FROM reservasi JOIN pesanan USING (id_reservasi) WHERE pesanan.id_pesanan='$id'";
    $res=$db->query($sql);
    $data=$res->fetch_all(MYSQLI_ASSOC);
    if(mysqli_num_rows($res)>0){
        $respon['harga']='25000';
    }else{
        $respon['harga']='0';
    }
    $respon["status"]="OK";
}
echo json_encode($respon);
?>


