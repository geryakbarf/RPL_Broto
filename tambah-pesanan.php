<?php include_once("functions.php"); ?>
<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: login.php");
}
if ($_SESSION["jabatan"] != "Pelayan") {
    header("Location: index.php");
}
$username = $_SESSION["nama"];
$idPes = getName(5);
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
    <?php sideBar(); ?>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <?php topBar($username) ?>
            <div class="container-fluid">
                <h3 class="text-dark mb-1">Tambah Pesanan (2)<br><br></h3>
            </div>
            <div class="input-group" style="margin-left: 20px;">
                <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                class="fa fa-align-justify"></i></span></div>
                <input type="text" class="form-control" placeholder="Id Pesanan" value="<?php echo $idPes; ?>" style="margin-right: 60px;" readonly></div>
            <div class="input-group" style="margin-left: 20px;">
                <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                class="fa fa-users"></i></span></div>
                <input type="text" class="form-control" placeholder="Jumlah Pelanggan" style="margin-right: 60px;">
            </div>
            <form>
                <div class="field" style="margin-left: 20px;margin-right: 40px;"><select class="form-control">
                        <optgroup label="Silahkan Pilih Meja Nomor">
                            <?php
                            $datakategori = getListMeja();
                            foreach ($datakategori as $data) {
                                echo "<option value=\"" . $data["no_meja"] . "\">" . $data["no_meja"] . "</option>";
                            }
                            ?>
                        </optgroup>
                    </select><label class="mb-0"
                                    for="float-input">Nomor Meja</label></div>
            </form>
            <div class="row" style="margin-left: 20px;margin-right: 40px;">
                <div class="col" style="width: 500px;">
                    <form>
                        <div class="field" style="margin-left: 0;">
                            <select class="form-control">
                                <optgroup label="Silahkan Pilih Menu">
                                    <?php
                                    $datakategori = getListMenu();
                                    foreach ($datakategori as $data) {
                                        echo "<option value=\"" . $data["id_menu"] . "\">" . $data["nama_menu"] . "</option>";
                                    }
                                    ?>
                                </optgroup>
                            </select>
                            <label
                                    class="mb-0" for="float-input">Pilih Menu</label>
                        </div>
                    </form>
                </div>
                <div class="col" style="margin-left: 0;">
                    <div class="input-group" style="margin-top: 20px;">
                        <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                        class="fa fa-align-justify"></i></span></div>
                        <input type="text" class="form-control" placeholder="Jumlah"></div>
                </div>
                <div class="col">
                    <button class="btn btn-primary" type="button" style="margin-top: 20px;">Tambah</button>
                </div>
            </div>
            <div class="card shadow" style="margin-top: 20px;margin-right: 40px;margin-left: 20px;">
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid"
                         aria-describedby="dataTable_info">
                        <table class="table dataTable my-0" id="dataTable">
                            <thead>
                            <tr>
                                <th>Nama Menu</th>
                                <th>Jumlah</th>
                                <th>Pilihan</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Nasi Goreng Biasa</td>
                                <td>2</td>
                                <td>Hapus</td>
                            </tr>
                            <tr>
                                <td>Nasi Goreng Jepang</td>
                                <td>3</td>
                                <td>Hapus</td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="button" style="margin-right: 40px;margin-top: 20px;">Simpan</button>
        </div>
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
</body>

</html>