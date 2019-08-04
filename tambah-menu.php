<?php include_once("functions.php"); ?>
<?php
session_start();
if (!isset($_SESSION["nip"]))
    header("Location: login.php");
$username = $_SESSION["nama"];
$randomId= getName(5);
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
                <h3 class="text-dark mb-1">Tambah Menu<br><br></h3>
            </div>
            <form name="f" method="post" action="proses/proses-tambah-menu.php" onsubmit="return validdasiData()">
                <div class="input-group" style="margin-left: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="fa fa-align-justify"></i></span></div>
                    <input type="text" name="id" value="<?php echo $randomId; ?>" class="form-control" placeholder="Id Menu" style="margin-right: 60px;" required readonly>
                </div>
                <div class="input-group" style="margin-left: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="fa fa-align-justify"></i></span></div>
                    <input type="text" class="form-control" name="nama" placeholder="Nama Menu"
                           style="margin-right: 60px;" required></div>
                <div class="input-group" style="margin-left: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="fa fa-align-justify"></i></span></div>
                    <input type="text" class="form-control" name="harga" placeholder="Harga Menu"
                           style="margin-right: 60px;" required></div>

                <div class="field"><select class="form-control" name="status"
                                           style="margin-right: 0px;margin-left: 20px;width: 910px;">
                        <optgroup label="Pilih Status Menu">
                            <option value="Tersedia" selected="">Tersedia</option>
                            <option value="Tidak Tersedia">Tidak Tersedia</option>
                        </optgroup>
                    </select><label class="mb-0"
                                    for="float-input" style="margin-left: 20px;">Status</label></div>
                <button class="btn btn-primary" name="TblSimpan" type="submit"
                        style="margin-top: 20px;margin-right: 40px;">Simpan
                </button>
            </form>

        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Brand 2019</span></div>
            </div>
        </footer>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
<script src="assets/js/Studious-selectbox.js"></script>
<script src="assets/js/theme.js"></script>
<SCRIPT>
    function validdasiData() {
        var angka= document.f.harga.value;
        if(isNaN(angka) || angka < 100){
            alert("Masukkan Harga Yang Valid!");
            return false;
        }
        return true;
    }
</SCRIPT>
</body>

</html>