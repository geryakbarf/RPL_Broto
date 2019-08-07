<?php include_once("functions.php"); ?>
<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: login.php");
}
if (!isset($_SESSION["jabatan"])=="Pantry") {
    header("Location: bahan-baku.php?halaman=1");
}
$username = $_SESSION["nama"];
$idBahan=$_GET['id'];
$namaBahan=$_GET['nama'];
$hargaBahan=$_GET['harga'];
$stokBahan=$_GET['stok'];
$satuanBahan=$_GET['satuan'];
$tgl=$_GET['tgl'];

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
                <h3 class="text-dark mb-1">Edit Bahan Baku<br><br></h3>
            </div>
            <form name="f" method="post" action="proses/proses-edit-bahan.php" onsubmit="return validdasiData()">
                <div class="input-group" style="margin-left: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="fa fa-align-justify"></i></span></div>
                    <input type="text" class="form-control" value="<?php echo $idBahan;?>" placeholder="Id Bahan Baku" name="id" style="margin-right: 60px;" readonly>
                </div>
                <div class="input-group" style="margin-left: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="fas fa-mortar-pestle"></i></span></div>
                    <input type="text" class="form-control" name="nama" value="<?php echo $namaBahan;?>" placeholder="Nama Bahan Baku" style="margin-right: 60px;" required maxlength="25">
                </div>
                <div class="input-group" style="margin-left: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="fas fa-money-bill-alt"></i></span></div>
                    <input type="text" class="form-control" name="harga" value="<?php echo $hargaBahan;?>" placeholder="Harga Bahan Baku" style="margin-right: 60px;" required maxlength="6">
                </div>
                <div class="input-group" style="margin-left: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="fas fa-dolly-flatbed"></i></span></div>
                    <input type="text" class="form-control" name="stok" placeholder="Stok Bahan Baku" value="<?php echo $stokBahan;?>" style="margin-right: 60px;" required maxlength="5">
                </div>

                <div class="field"><select class="form-control" name="satuan"
                                           style="margin-right: 0px;margin-left: 20px;width: 910px;">
                        <optgroup label="Pilih Satuan Untuk Stok">
                            <?php
                            if($satuanBahan=='Kg'){
                                ?>
                                <option value="Kg" selected="">Kg</option>
                                <option value="Bungkus">Bungkus</option>
                                <option value="Buah">Buah</option>
                            <?php
                            }else if($satuanBahan=='Bungkus'){
                                ?>
                                <option value="Kg">Kg</option>
                                <option value="Bungkus" selected>Bungkus</option>
                                <option value="Buah">Buah</option>
                            <?php
                            }else{
                                ?>
                                <option value="Kg">Kg</option>
                                <option value="Bungkus">Bungkus</option>
                                <option value="Buah" selected>Buah</option>
                            <?php
                            }
                            ?>

                        </optgroup>
                    </select><label class="mb-0"
                                    for="float-input" style="margin-left: 20px;">Satuan Stok</label></div>
                <h3 class="text-dark mb-4" style="margin-left: 20px;margin-bottom: 0px;">Tanggal Kadaluarsa</h3>
                <div class="input-group" style="margin-left: 20px;margin-right: 20px;">

                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i class="far fa-calendar-times"></i></span></div><input type="date" name="tanggal" value="<?php echo $tgl;?>" required></div>

                <button class="btn btn-primary" type="submit"
                        style="margin-top: 20px;margin-right: 40px;" name="TblUpdate">Simpan
                </button>
        </div>
        </form>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Brand 2019</span></div>
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
        var angka= document.f.harga.value;
        if(isNaN(angka) || angka.length==0 || angka<0){
            alert("Masukkan Harga Yang Valid!");
            return false;
        }

        var stok= document.f.stok.value;
        if(isNaN(stok) || stok.length==0 || stok<0){
            alert("Masukkan Jumlah Stok Yang Valid!");
            return false;
        }
        return true;
    }
</SCRIPT>
</body>

</html>