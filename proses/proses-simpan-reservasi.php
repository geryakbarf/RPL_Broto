
<?php include_once("../functions.php"); ?>

<?php
if(isset($_POST['TblUpdate'])){
    $db=dbConnect();
    $meja=$db->escape_string($_POST['meja']);
    $tgl=$db->escape_string($_POST['tanggal']);
    $jam=$db->escape_string($_POST['jam']);
    $idpes=$db->escape_string($_POST['idpes']);
    $idres=$db->escape_string($_POST['idres']);
    $tanggal=$tgl." ".$jam;
    $sql1="UPDATE pesanan SET no_meja='$meja' WHERE id_pesanan='$idpes'";
    $sql2="UPDATE reservasi SET tanggal='$tanggal' WHERE id_reservasi='$idres'";
    $db->query($sql1);
    $res=$db->query($sql2);
    if($db->affected_rows>0){
        header("Location: ../reservasi.php?halaman=1");
    }else
        header("Location: ../reservasi.php?halaman=1");

}



?>