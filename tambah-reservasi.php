<?php include_once("functions.php"); ?>
<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: login.php");
}

$username = $_SESSION["nama"];
$idRes = getName(5);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Tambah Reservasi - Broto</title>
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
    if ($_SESSION["jabatan"] == "Koki") {
        sideBarKoki();
    } else if ($_SESSION["jabatan"] == "Pantry") {
        sideBarPantry();
    } else if ($_SESSION["jabatan"] == "Pelayan") {
        sideBarPelayan();
    } else if ($_SESSION["jabatan"] == "Kasir") {
        sideBarKasir();
    } else if ($_SESSION["jabatan"] == "Customer Service") {
        sideBarCS();
    } else if ($_SESSION["jabatan"] == "Owner") {
        sideBarOwner();
    }
    ?>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <?php topBar($username); ?>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Reservasi</h3>
            </div>
            <form name="f" method="post" action="tambah-pesanan.php" onsubmit="return validdasiData()">
                <div class="input-group" style="margin-right: 20px;margin-left: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="fas fa-envelope"></i></span></div>
                    <input type="text" name="idRes" class="form-control" value="<?php echo $idRes; ?>"
                           placeholder="Id Reservasi" style="margin-right: 60px;" readonly></div>
                <div class="input-group" style="margin-right: 20px;margin-left: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="far fa-user"></i></span></div>
                    <input type="text" name="nama" class="form-control" placeholder="Nama Pemesan" required
                           style="margin-right: 60px;" maxlength="25"></div>
                <div class="input-group" style="margin-right: 20px;margin-left: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="fa fa-users"></i></span></div>
                    <input type="number" name="jumlahOrang" class="form-control" placeholder="Jumlah Pemesan" required
                           style="margin-right: 60px;" maxlength="1"></div>
                <h3 class="text-dark mb-4" style="margin-left: 20px;margin-bottom: 0px;">Tanggal Reservasi</h3>
                <div class="input-group" style="margin-left: 20px;margin-right: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="far fa-calendar-times"></i></span></div>
                    <input type="date" name="tanggal" required><input type="time" name="jam" required></div>
                <button class="btn btn-primary" type="submit   " name="TblReservasi" style="margin-right: 40px;">
                    Lanjut
                </button>
        </div>
        </form>
        <footer
                class="bg-white sticky-footer">
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
        if(isNaN(angka) || angka.length==0 || angka<1){
            alert("Masukkan Jumlah Pelanggan Yang Valid!");
            return false;
        }
        return true;
    }
</SCRIPT>
</body>

</html>