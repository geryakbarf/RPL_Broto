<?php include_once("functions.php"); ?>
<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: login.php");
}
if ($_SESSION["jabatan"] != "Pelayan" and $_SESSION["jabatan"] != "Koki" and $_SESSION["jabatan"] != "Pantry") {
    header("Location: index.php");
}
$username = $_SESSION["nama"];
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
            <?php topBar($username); ?>
            <div class="container-fluid">
                <h3 class="text-dark mb-1">Data Dapur</h3>
            </div>
            <div class="container" style="height: 200px;margin-top: 20px;">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <a href="bahan-baku.php">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                                        <span>Bahan Baku</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span>Kelola<br>Data Bahan Baku<br>Resto Broto<br><br><br></span>
                                                    </div>
                                                </div>
                                                <div class="col-auto"><i
                                                            class="fas fa-warehouse fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="belanja.php">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                                        <span>Data belanja</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span>Kelola<br>Data Belanja <br>Resto Broto<br><br><br></span>
                                                    </div>
                                                </div>
                                                <div class="col-auto"><i
                                                            class="fas fa-shopping-cart fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col">
                                <a href="kebutuhan-koki.php">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row align-items-center no-gutters">
                                                <div class="col mr-2">
                                                    <div class="text-uppercase text-primary font-weight-bold text-xs mb-1">
                                                        <span>Keperluan Koki</span></div>
                                                    <div class="text-dark font-weight-bold h5 mb-0"><span>Kelola<br>Keperluan Koki<br>Resto Broto<br><br><br></span>
                                                    </div>
                                                </div>
                                                <div class="col-auto"><i
                                                            class="fas fa-hands-helping fa-2x text-gray-300"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © RamenkKu 2019</span></div>
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