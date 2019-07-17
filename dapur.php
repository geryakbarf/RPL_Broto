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
    <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
        <div class="container-fluid d-flex flex-column p-0">
            <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-hotel"></i></div>
                <div class="sidebar-brand-text mx-3"><span>Resto Broto</span></div>
            </a>
            <hr class="sidebar-divider my-0">
            <ul class="nav navbar-nav text-light" id="accordionSidebar">
                <li class="nav-item" role="presentation"><a class="nav-link" href="index.php"><i
                                class="fas fa-home"></i><span>Beranda</span></a><a class="nav-link" href="menu.php"><i
                                class="fab fa-readme"></i><span>Menu</span></a><a class="nav-link"
                                                                                  href="reservasi.php"><i
                                class="fas fa-table"></i><span>Reservasi</span></a>
                    <a
                            class="nav-link" href="meja.html"><i class="fas fa-ticket-alt"></i><span>Meja</span><a
                                class="nav-link" href="pesanan.php"><i
                                    class="fas fa-newspaper"></i><span>Pesanan</span></a><a class="nav-link"
                                                                                            href="pembayaran.php"><i
                                    class="fas fa-money-bill-alt"></i><span>Pembayan</span></a>
                        <a
                                class="nav-link" href="kuisioner.php"><i
                                    class="fas fa-clipboard"></i><span>Kuisioner</span></a><a class="nav-link active"
                                                                                              href="dapur.php"><i
                                    class="fas fa-warehouse"></i><span>Data Dapur</span></a></li>
            </ul>
            <ul class="nav navbar-nav text-light" id="accordionSidebar"></ul>
            <div class="text-center d-none d-md-inline">
                <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
            </div>
        </div>
    </nav>
    <div class="d-flex flex-column" id="content-wrapper">
        <div id="content">
            <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                <div class="container-fluid">
                    <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i
                                class="fas fa-bars"></i></button>
                    <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text"
                                                        placeholder="Search for ...">
                            <div class="input-group-append">
                                <button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul class="nav navbar-nav flex-nowrap ml-auto">
                        <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                                                            data-toggle="dropdown" aria-expanded="false"
                                                                            href="#"><i class="fas fa-search"></i></a>
                            <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu"
                                 aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto navbar-search w-100">
                                    <div class="input-group"><input class="bg-light form-control border-0 small"
                                                                    type="text" placeholder="Search for ...">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary py-0" type="button"><i
                                                        class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                        <li class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                                                  data-toggle="dropdown" aria-expanded="false" href="#"><span
                                        class="badge badge-danger badge-counter">3+</span><i
                                        class="fas fa-bell fa-fw"></i></a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in"
                                 role="menu">
                                <h6 class="dropdown-header">alerts center</h6>
                                <a class="d-flex align-items-center dropdown-item" href="#">
                                    <div class="mr-3">
                                        <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div><span class="small text-gray-500">December 12, 2019</span>
                                        <p>A new monthly report is ready to download!</p>
                                    </div>
                                </a>
                                <a class="d-flex align-items-center dropdown-item" href="#">
                                    <div class="mr-3">
                                        <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div><span class="small text-gray-500">December 7, 2019</span>
                                        <p>$290.29 has been deposited into your account!</p>
                                    </div>
                                </a>
                                <a class="d-flex align-items-center dropdown-item" href="#">
                                    <div class="mr-3">
                                        <div class="bg-warning icon-circle"><i
                                                    class="fas fa-exclamation-triangle text-white"></i></div>
                                    </div>
                                    <div><span class="small text-gray-500">December 2, 2019</span>
                                        <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                                    </div>
                                </a><a class="text-center dropdown-item small text-gray-500" href="#">Show All
                                    Alerts</a></div>
                        </li>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow" role="presentation">
                        <li class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                                                  data-toggle="dropdown" aria-expanded="false" href="#"><span
                                        class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $username; ?></span><img
                                        class="border rounded-circle img-profile" src="assets/img/avatars/avatar1.jpeg"></a>
                            <div
                                    class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a
                                        class="dropdown-item" role="presentation" href="#"><i
                                            class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a
                                        class="dropdown-item" role="presentation" href="#"><i
                                            class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                                <a
                                        class="dropdown-item" role="presentation" href="#"><i
                                            class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity
                                    log</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" role="presentation" href="#"><i
                                            class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Logout</a>
                            </div>
                        </li>
                        </li>
                    </ul>
                </div>
            </nav>
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