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

function getListBahan($id)
{
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $res = $db->query("SELECT * FROM bahan_baku WHERE stok_bahan > 0 AND id_bahan_baku NOT IN (SELECT id_bahan_baku FROM detail_kebutuhan WHERE id_kebutuhan='$id') ORDER BY nama_bahan");
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else
            return FALSE;
    } else
        return FALSE;
}

function getBahan($id)
{
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $res = $db->query("SELECT * FROM bahan_baku WHERE id_bahan_baku NOT IN (SELECT id_bahan_baku FROM detail_belanja WHERE id_belanja='$id') ORDER BY nama_bahan");
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else
            return FALSE;
    } else
        return FALSE;
}

function getListDetailBelanja($idBelanja){
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $res = $db->query("SELECT detail_belanja.id_bahan_baku, data_belanja.Tanggal,data_belanja.total_biaya,bahan_baku.nama_bahan, detail_belanja.jumlah_beli,bahan_baku.satuan, detail_belanja.sub_total 
                                    FROM data_belanja JOIN detail_belanja ON data_belanja.id_belanja=detail_belanja.id_belanja JOIN bahan_baku ON detail_belanja.id_bahan_baku=bahan_baku.id_bahan_baku 
                                    WHERE detail_belanja.id_belanja='$idBelanja'");
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else
            return FALSE;
    } else
        return FALSE;
}

function getListDetailKebutuhan($idKebutuhan){
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $res = $db->query("SELECT bahan_baku.nama_bahan, detail_kebutuhan.jumlah, bahan_baku.satuan ,bahan_baku.id_bahan_baku
                                    FROM detail_kebutuhan JOIN bahan_baku ON detail_kebutuhan.id_bahan_baku=bahan_baku.id_bahan_baku 
                                        WHERE detail_kebutuhan.id_kebutuhan='$idKebutuhan' ");
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else
            return FALSE;
    } else
        return FALSE;
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

function getListKebutuhan($id)
{
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $res = $db->query("SELECT bahan_baku.id_bahan_baku, bahan_baku.nama_bahan, detail_kebutuhan.jumlah, bahan_baku.satuan FROM bahan_baku JOIN detail_kebutuhan ON bahan_baku.id_bahan_baku=detail_kebutuhan.id_bahan_baku WHERE detail_kebutuhan.id_kebutuhan='$id'");
        if ($res) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            $res->free();
            return $data;
        } else
            return FALSE;
    } else
        return FALSE;
}

function getDetailMenu($idpes)
{
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



function getListMenu($idPes)
{
    $db = dbConnect();
    if ($db->connect_errno == 0) {
        $res = $db->query("SELECT * 
						 FROM menu WHERE status = 'Tersedia' AND menu.id_menu NOT IN (SELECT detail_pesanan.id_menu FROM detail_pesanan WHERE detail_pesanan.id_pesanan='$idPes')
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

function getMenu()
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
        $res = $db->query("SELECT pesanan.id_pesanan, pelanggan.atas_nama, pesanan.no_meja, pegawai.nama, pesanan.status FROM pesanan JOIN pelanggan ON pesanan.id_pelanggan=pelanggan.id_pelanggan JOIN pegawai ON pesanan.pelayan=pegawai.nip ORDER BY FIELD(status,'Pending','Dimasak','Selesai','Dibayar')");
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
        $res = $db->query("SELECT reservasi.id_reservasi, reservasi.tanggal, pesanan.nama_pelanggan, pesanan.no_meja, pesanan.id_pesanan FROM reservasi JOIN pesanan ON reservasi.id_reservasi=pesanan.id_reservasi  ORDER BY reservasi.tanggal");
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

function sideBarKoki()
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
                                class="fas fa-home"></i><span>Beranda</span></a><a class="nav-link"
                                                                                   href="menu.php?halaman=1"><i
                                class="fab fa-readme"></i><span>Menu</span></a>
                    <a
                            class="nav-link" href="pesanan.php?halaman=1"><i
                                class="fas fa-newspaper"></i><span>Pesanan</span></a>
                    <a
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
                                class="fas fa-home"></i><span>Beranda</span></a><a class="nav-link"
                                                                                   href="menu.php?halaman=1"><i
                                class="fab fa-readme"></i><span>Menu</span></a><a class="nav-link"
                                                                                  href="reservasi.php?halaman=1"><i
                                class="fas fa-table"></i><span>Reservasi</span></a>
                    <a
                            class="nav-link" href="meja.php?halaman=1"><i
                                class="fas fa-ticket-alt"></i><span>Meja</span></a><a
                            class="nav-link" href="pesanan.php?halaman=1"><i
                                class="fas fa-newspaper"></i><span>Pesanan</span></a><a
                            class="nav-link" href="pembayaran.php?halaman=1"><i
                                class="fas fa-money-bill-alt"></i><span>Pembayaran</span></a>
                    <a
                            class="nav-link" href="kuisioner.php?halaman=1"><i class="fas fa-clipboard"></i><span>Kuisioner</span></a><a
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

function sideBarCS()
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
                                class="fas fa-home"></i><span>Beranda</span></a>
                    <a
                            class="nav-link" href="kuisioner.php?halaman=1"><i class="fas fa-clipboard"></i><span>Kuisioner</span></a></li>
            </ul>
            <div class="text-center d-none d-md-inline">
                <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
            </div>
        </div>
    </nav>
    <?php
}

function sideBarKasir()
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
                                class="fas fa-home"></i><span>Beranda</span></a><a
                            class="nav-link" href="pembayaran.php?halaman=1"><i
                                class="fas fa-money-bill-alt"></i><span>Pembayaran</span></a>
                  </li>
            </ul>
            <div class="text-center d-none d-md-inline">
                <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
            </div>
        </div>
    </nav>
    <?php
}

function sideBarOwner()
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
                                class="fas fa-home"></i><span>Laporan</span></a>
                </li>
            </ul>
            <div class="text-center d-none d-md-inline">
                <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
            </div>
        </div>
    </nav>
    <?php
}

function sideBarPelayan()
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
                                class="fas fa-home"></i><span>Beranda</span></a><a class="nav-link"
                                                                                   href="menu.php?halaman=1"><i
                                class="fab fa-readme"></i><span>Menu</span></a><a class="nav-link"
                                                                                  href="reservasi.php?halaman=1"><i
                                class="fas fa-table"></i><span>Reservasi</span></a>
                    <a
                            class="nav-link" href="meja.php?halaman=1"><i
                                class="fas fa-ticket-alt"></i><span>Meja</span></a><a
                            class="nav-link" href="pesanan.php?halaman=1"><i
                                class="fas fa-newspaper"></i><span>Pesanan</span></a></li>
            </ul>
            <div class="text-center d-none d-md-inline">
                <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
            </div>
        </div>
    </nav>
    <?php
}


function sideBarPantry()
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
                                class="fas fa-home"></i><span>Beranda</span></a><a
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
                            class="dropdown-menu shadow dropdown-menu-right animated--grow-in" role="menu">
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