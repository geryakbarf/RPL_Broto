<?php include_once("functions.php") ?>
<?php
session_start();
if (!isset($_SESSION["nip"]))
    header("Location: login.php");
$username = $_SESSION["nama"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Blank Page - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
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
                <h3 class="text-dark mb-1">Tambah Kuisioner<br><br></h3>
            </div>
            <div class="card">
                <div class="card-body">
                    <form name="f" method="post" action="proses/proses-tambah-kuisioner.php">
                    <h6 class="text-muted card-subtitle mb-2">Pertanyaan</h6><textarea style="width: 850px;max-width: 850px;max-height: auto;" name="isi" maxlength="100" required></textarea></div>
            </div><button class="btn btn-primary" name="TblSimpan" type="submit" style="margin-top: 20px;margin-right: 40px;">Simpan</button></form></div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Brand 2019</span></div>
            </div>
        </footer>
    </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a></div>
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