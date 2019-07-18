<?php

define("DEVELOPMENT", TRUE);

function dbConnect()
{
    $db = new mysqli("localhost", "root", "", "db_resto_broto");
    return $db;
}

function showError($message)
{
    ?>
    <div style="background-color:#FAEBD7;padding:10px;border:1px solid red;margin:15px 0px">
        <?php echo $message; ?>
    </div>
    <?php
}

function getListMeja()
{
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $res = $db->query("SELECT * FROM meja WHERE Status ='Kosong' ORDER BY no_meja");
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else
            return FALSE;
    } else
        return FALSE;
}

function getDetailMenu($idpes){
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $res = $db->query("SELECT menu.nama_menu,detail_pesanan.jumlah,detail_pesanan.id_menu,detail_pesanan.id_pesanan FROM menu JOIN detail_pesanan ON menu.id_menu=detail_pesanan.id_menu WHERE detail_pesanan.id_pesanan='$idpes'");
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else
            return FALSE;
    } else
        return FALSE;
}

function getListMenu()
{
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $res = $db->query("SELECT * 
						 FROM menu WHERE status = 'Tersedia'
						 ORDER BY nama_menu");
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else
            return FALSE;
    } else
        return FALSE;
}

function getListPesanan()
{
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $res = $db->query("SELECT pesanan.id_pesanan, pelanggan.atas_nama, pesanan.no_meja, pegawai.nama, pesanan.status FROM pesanan JOIN pelanggan ON pesanan.id_pelanggan=pelanggan.id_pelanggan JOIN pegawai ON pesanan.pelayan=pegawai.nip ORDER BY FIELD(status,'Selesai','Pending','Dimasak','Dibayar')");
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else
            return FALSE;
    } else
        return FALSE;
}

function getListReservasi()
{
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $res = $db->query("SELECT reservasi.id_reservasi, reservasi.tanggal, pelanggan.atas_nama, pesanan.no_meja, pesanan.id_pesanan FROM reservasi JOIN pesanan ON reservasi.id_reservasi=pesanan.id_reservasi JOIN pelanggan ON pesanan.id_pelanggan=pelanggan.id_pelanggan ORDER BY reservasi.tanggal");
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else
            return FALSE;
    } else
        return FALSE;
}

function getName($n)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }

    return $randomString;
}

function sideBar()
{

    ?>
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
                                class="fab fa-readme"></i><span>Menu</span></a><a class="nav-link" href="reservasi.php"><i
                                class="fas fa-table"></i><span>Reservasi</span></a>
                    <a
                            class="nav-link" href="meja.php"><i class="fas fa-ticket-alt"></i><span>Meja</span></a><a
                            class="nav-link" href="pesanan.php"><i class="fas fa-newspaper"></i><span>Pesanan</span></a><a
                            class="nav-link" href="pembayaran.php"><i
                                class="fas fa-money-bill-alt"></i><span>Pembayaran</span></a>
                    <a
                            class="nav-link" href="kuisioner.php"><i class="fas fa-clipboard"></i><span>Kuisioner</span></a><a
                            class="nav-link" href="dapur.php"><i
                                class="fas fa-warehouse"></i><span>Data Dapur</span></a></li>
            </ul>
            <div class="text-center d-none d-md-inline">
                <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
            </div>
        </div>
    </nav>
    <?php
}

function topBar($username)
{
    ?>
    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
        <div class="container-fluid">
            <button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i
                        class="fas fa-bars"></i></button>
            <ul class="nav navbar-nav flex-nowrap ml-auto">
                <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                                                    data-toggle="dropdown" aria-expanded="false"
                                                                    href="#"><i class="fas fa-search"></i></a>
                    <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu"
                         aria-labelledby="searchDropdown">
                        <form class="form-inline mr-auto navbar-search w-100">
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text"
                                                            placeholder="Search for ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
                <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                <li class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown"
                                                          aria-expanded="false" href="#"><span
                                class="badge badge-danger badge-counter">3+</span><i class="fas fa-bell fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in"
                         role="menu">
                        <h6 class="dropdown-header">alerts center</h6>
                        <a class="d-flex align-items-center dropdown-item" href="#">
                            <div class="mr-3">
                                <div class="bg-primary icon-circle"><i class="fas fa-file-alt text-white"></i></div>
                            </div>
                            <div><span class="small text-gray-500">December 12, 2019</span>
                                <p>A new monthly report is ready to download!</p>
                            </div>
                        </a>
                        <a class="d-flex align-items-center dropdown-item" href="#">
                            <div class="mr-3">
                                <div class="bg-success icon-circle"><i class="fas fa-donate text-white"></i></div>
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
                        </a><a class="text-center dropdown-item small text-gray-500" href="#">Show All Alerts</a></div>
                </li>
                </li>
                <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                    <div class="shadow dropdown-list dropdown-menu dropdown-menu-right"
                         aria-labelledby="alertsDropdown"></div>
                </li>
                <div class="d-none d-sm-block topbar-divider"></div>
                <li class="nav-item dropdown no-arrow" role="presentation">
                <li class="nav-item dropdown no-arrow"><a class="dropdown-toggle nav-link" data-toggle="dropdown"
                                                          aria-expanded="false" href="#"><span
                                class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $username; ?></span><img
                                class="border rounded-circle img-profile" src="assets/img/avatars/avatar4.jpeg"></a>
                    <div
                            class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu"><a
                                class="dropdown-item" role="presentation" href="#"><i
                                    class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Profile</a><a
                                class="dropdown-item" role="presentation" href="#"><i
                                    class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Settings</a>
                        <a
                                class="dropdown-item" role="presentation" href="#"><i
                                    class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Activity log</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" role="presentation" href="proses/proses-logout.php"><i
                                    class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>&nbsp;Keluar</a>
                    </div>
                </li>
                </li>
            </ul>
        </div>
    </nav>
    <?php
}


?>