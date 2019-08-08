<?php include_once("functions.php"); ?>
<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: login.php");
}
$username = $_SESSION["nama"];
$idKebutuhan = $_GET['id'];
$status = $_GET['status'];
$menu = $_GET['menu'];
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
            <?php topBar($username) ?>
            <div class="container-fluid">
                <h3 class="text-dark mb-1">Detail Kebutuhan<br></h3>
            </div>

            <div class="input-group" style="margin-left: 20px;margin-top: 20px;">
                <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                class="fa fa-align-justify"></i></span></div>
                <form name="f" method="post" action="proses/proses-edit-kebutuhan.php">
                <input type="text" class="form-control" placeholder="ID Belanja" style="margin-right: 60px;" readonly
                       value="<?php echo $idKebutuhan ?>" name="id"></div>
            <div class="field" style="margin-left: 20px;margin-right: 40px;">
                <input type="text" class="form-control" style="margin-right: 60px;" readonly
                       value="<?php echo $menu ?>">
                <label
                        class="mb-0" for="float-input">Kebutuhan Untuk Menu</label>
            </div>
            <div class="card shadow" style="margin-top: 20px;margin-right: 40px;margin-left: 20px;">
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid"
                         aria-describedby="dataTable_info">
                        <table class="table dataTable my-0" id="dataTable">
                            <thead>
                            <tr>
                                <th>Bahan Baku</th>
                                <th>Jumlah</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $detail = getListDetailKebutuhan($idKebutuhan);
                            foreach ($detail as $data) {
                                ?>
                                <tr>
                                    <td><?php echo $data['nama_bahan']; ?></td>
                                    <td><?php echo $data['jumlah'] . " " . $data['satuan']; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                            <tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                        <div class="field"><select class="form-control" name="status">
                                <optgroup label="Pilih Status Kebutuhan ">
                                    <?php
                                    if ($status == 'Pending') {
                                        ?>
                                        <option value="Pending" selected="selected">Pending</option>
                                        <option value="Tidak Tersedia">Tidak Tersedia</option>
                                        <option value="Selesai">Selesai</option>
                                        <?php
                                    } else if ($status == 'Tidak Tersedia') {
                                        ?>
                                        <option value="Tidak Tersedia" selected="selected">Tidak Tersedia</option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="Selesai" selected="selected">Selesai</option>
                                        <?php
                                    }
                                    ?>
                                </optgroup>
                            </select>
                            <label
                                    class="mb-0" for="float-input">Status</label>
                        </div>

                </div>
            </div>
            <?php
            if ($status == "Pending") {
                ?>
                <button class="btn btn-primary" type="submit" name="TblUpdate"
                        style="margin-right: 40px;margin-top: 20px;">Simpan
                </button>
                <?php
            } else {
                ?>
                <button class="btn btn-primary" type="button" style="margin-right: 40px;margin-top: 20px;"
                        onclick="window.history.back()">Kembali
                </button>
                <?php
            }
            ?>
            </form>
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