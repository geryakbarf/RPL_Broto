<?php
include_once"../functions.php";
$db = dbConnect();
if ($db->connect_errno == 0) {
    $tanggal = date("Y-m-d");
    $pertanyaan = $db->escape_string($_POST['pertanyaan']);
    $nopem = $db->escape_string($_POST['nopem']);
    $jawaban = $db->escape_string($_POST['jawaban']);
    $sqlku = "SELECT * FROM detail_kuis WHERE no_pembayaran='$nopem' AND id_kuis='$pertanyaan'";
    $hasil = $db->query($sqlku);
    if (mysqli_num_rows($hasil) > 0) {
        header("Location: ../index.php?error=1");
    } else {
        $sql = "INSERT INTO detail_kuis VALUES('$nopem','$pertanyaan','$tanggal','$jawaban')";
        $res = $db->query($sql);
        if ($res) {
            if ($db->affected_rows > 0) {
                header("Location: ../alert.php");
            }else
                header("Location: ../index.php?error=2");
        }else
            header("Location: ../index.php?error=3");
    }
}
?>