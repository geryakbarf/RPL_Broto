<?php
session_start();
if (!isset($_SESSION["nip"]))
    header("Location: login.php");
$username = $_SESSION["nama"];
if ($_SESSION["jabatan"] != "Koki") {
    header("Location: menu.php");

}
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
            <hr class="sidebar-divider my-0">
            <ul class="nav navbar-nav text-light" id="accordionSidebar"></ul>
            <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
                <div class="container-fluid d-flex flex-column p-0">
                    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0"
                       href="index.php">
                        <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-hotel"></i></div>
                        <div class="sidebar-brand-text mx-3"><span>Resto Broto</span></div>
                    </a>
                    <hr class="sidebar-divider my-0">
                    <ul class="nav navbar-nav text-light" id="accordionSidebar">
                        <li class="nav-item" role="presentation"><a class="nav-link" href="index.php"><i
                                        class="fas fa-home"></i><span>Beranda</span></a><a class="nav-link"
                                                                                           href="menu.php"><i
                                        class="fab fa-readme"></i><span>Menu</span></a><a class="nav-link"
                                                                                          href="reservasi.html"><i
                                        class="fas fa-table"></i><span>Reservasi</span></a>
                            <a
                                    class="nav-link" href="meja.html"><i class="fas fa-ticket-alt"></i><span>Meja</span></a><a
                                    class="nav-link" href="pesanan.html"><i
                                        class="fas fa-newspaper"></i><span>Pesanan</span></a><a class="nav-link"
                                                                                                href="pembayaran.html"><i
                                        class="fas fa-money-bill-alt"></i><span>Pembayan</span></a>
                            <a
                                    class="nav-link" href="kuisioner.html"><i class="fas fa-clipboard"></i><span>Kuisioner</span></a><a
                                    class="nav-link" href="dapur.html"><i
                                        class="fas fa-warehouse"></i><span>Data Dapur</span></a></li>
                    </ul>
                    <div class="text-center d-none d-md-inline">
                        <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
                    </div>
                </div>
            </nav>
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
                        <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                            <div class="shadow dropdown-list dropdown-menu dropdown-menu-right"
                                 aria-labelledby="alertsDropdown"></div>
                        </li>
                        <div class="d-none d-sm-block topbar-divider"></div>
                        <li class="nav-item dropdown no-arrow" role="presentation">
                        <li class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link"
                                                                  data-toggle="dropdown" aria-expanded="false" href="#"><span
                                        class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $username ?></span><img
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
                                <a class="dropdown-item" role="presentation" href="proses-logout.php"><i
                                            class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Keluar</a>
                            </div>
                        </li>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
                <h3 class="text-dark mb-1">Tambah Menu<br><br></h3>
            </div>
            <div class="input-group" style="margin-left: 20px;">
                <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                class="fa fa-align-justify"></i></span></div>
                <input type="text" class="form-control" placeholder="Nama Menu" style="margin-right: 60px;"></div>
            <div class="input-group" style="margin-left: 20px;">
                <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                class="fa fa-align-justify"></i></span></div>
                <input type="text" class="form-control" placeholder="Harga Menu" style="margin-right: 60px;"></div>
            <form>
                <div class="field"><select class="form-control"
                                           style="margin-right: 0px;margin-left: 20px;width: 910px;">
                        <optgroup label="Pilih Status Menu">
                            <option value="1" selected="">Tersedia</option>
                            <option value="0">Tidak Tersedia</option>
                        </optgroup>
                    </select><label class="mb-0"
                                    for="float-input" style="margin-left: 20px;">Status</label></div>
            </form>
            <button class="btn btn-primary" type="button" style="margin-top: 20px;margin-right: 40px;">Simpan</button>
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
</body>

</html>