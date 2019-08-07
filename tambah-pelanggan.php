<?php include_once("functions.php"); ?>
<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: login.php");
}
$username = $_SESSION["nama"];
?>
<?php
$idPel = getName(5);
$_SESSION['idPel'] = $idPel;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blank Page - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Icon-Input.css">
    <link rel="stylesheet" href="assets/css/select.css">
    <link rel="stylesheet" href="assets/css/Studious-selectbox.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body id="page-top">
<div id="wrapper">
    <?php
    if($_SESSION["jabatan"]=="Koki") {
        sideBarKoki();
    }else if($_SESSION["jabatan"]=="Pantry") {
        sideBarPantry();
    }else if($_SESSION["jabatan"]=="Pelayan") {
        sideBarPelayan();
    }else if($_SESSION["jabatan"]=="Kasir") {
        sideBarKasir();
    }else if($_SESSION["jabatan"]=="Customer Service") {
        sideBarCS();
    }else if($_SESSION["jabatan"]=="Owner") {
        sideBarOwner();
    }
    ?>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <?php topBar($username); ?>
            <div class="container-fluid">
                <h3 class="text-dark mb-1">Tambah Pesanan (1)<br><br></h3>
            </div>
            <form name="f" method="post" action="tambah-pesanan.php" onsubmit="return validdasiData()">

                <div class="input-group" style="margin-left: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="fas fa-user"></i></span></div>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Pemesan"
                           style="margin-right: 60px;" maxlength="25" required></div>
                <div class="input-group" style="margin-left: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="fa fa-users"></i></span></div>
                    <input type="text" class="form-control" name="jumlahOrang" placeholder="Jumlah Pelanggan"
                           style="margin-right: 60px;" maxlength="2" required></div>
                    <button class="btn btn-primary" type="submit"
                            style="margin-top: 20px;margin-right: 40px;" name="TblPesanan">Lanjut
                    </button>

        </div>
        </form>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © RamenKu 2019</span></div>
            </div>
        </footer>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/Bootstrap-DateTime-Picker-1.js"></script>
<script src="assets/js/Bootstrap-DateTime-Picker-2.js"></script>
<script src="assets/js/Bootstrap-DateTime-Picker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/Studious-selectbox.js"></script>
<script src="assets/js/theme.js"></script>
<SCRIPT>
    function validdasiData() {
        var angka= document.f.jumlahOrang.value;
        if(isNaN(angka) || angka >= 10 || angka.length==0 || angka<0){
            alert("Masukkan Jumlah Pelanggan Yang Valid!");
            return false;
        }
        var menu= document.f.nama.value;
        if(menu.length==0){
            alert("Masukkan Nama Pelanggan!");
            return false;
        }
        return true;
    }
</SCRIPT>
</body>

</html>