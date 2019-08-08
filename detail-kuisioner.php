<?php include_once("functions.php") ?>
<?php
session_start();
if (!isset($_SESSION["nip"]))
    header("Location: login.php");
$username = $_SESSION["nama"];
$isi = getIsi($_GET['id']);
$id=$_GET['id'];
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
            <?php topBar($username); ?>
            <div class="container-fluid">
                <h3 class="text-dark mb-1">Detail Kuisioner<br></h3>
            </div>
            <div class="card" style="margin-right: 40px;margin-left: 20px;">
                <div class="card-body">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                        class="fa fa-align-justify"></i></span></div>
                        <input type="text" readonly value="<?php echo $isi; ?>" class="form-control"
                               placeholder="Pertanyaan"></div>
                </div>
            </div>
            <div class="card shadow" style="margin-top: 20px;margin-right: 40px;margin-left: 20px;">
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid"
                         aria-describedby="dataTable_info">
                        <table class="table dataTable my-0" id="dataTable">
                            <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th class="text-center">Jawaban</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $db = dbConnect();
                            $batas = 10;
                            $halaman = $_GET['halaman'];
                            if (empty($halaman)) {
                                $posisi = 0;
                                $halaman = 1;
                            } else {
                                $posisi = ($halaman - 1) * $batas;
                            }
                            if ($db->connect_errno == 0) {
                                $res = $db->query("SELECT detail_kuis.no_pembayaran,pesanan.nama_pelanggan, detail_kuis.tanggal, detail_kuis.jawaban_kuis FROM detail_kuis JOIN pembayaran ON detail_kuis.no_pembayaran=pembayaran.no_pembayaran
                                                        JOIN pesanan ON pembayaran.id_pesanan=pesanan.id_pesanan WHERE detail_kuis.id_kuis='$id' ORDER BY detail_kuis.tanggal DESC LIMIT $posisi,$batas ");
                                if ($res) {
                                    $jmldata = mysqli_num_rows($res);
                                    $jmlhalaman = ceil($jmldata / $batas);
                                    $datajadwal = $res->fetch_all(MYSQLI_ASSOC);
                                    foreach ($datajadwal as $data) {
                                        ?>
                                        <tr>
                                            <td><?php echo $data['tanggal']; ?></td>
                                            <td><?php echo $data['nama_pelanggan']; ?></td>
                                            <td class="text-center"><a
                                                        href="detail-jawaban.php?nopem=<?php echo $data['no_pembayaran']; ?>&id=<?php echo $id;?>">
                                                    <?php echo substr($data['jawaban_kuis'],0,100)?></a></td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            ?>
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
                    <div class="row">
                        <div class="col-md-6 align-self-center">
                            <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">Halaman
                                <?php echo $halaman ?></p>
                        </div>
                        <div class="col-md-6">
                            <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                <ul class="pagination">
                                    <?php
                                    for ($i = 1; $i <= $jmlhalaman; $i++)
                                        if ($i != $halaman) {
                                            ?>
                                            <li class="page-item"><a class="page-link"
                                                                     href="detail-kuisioner.php?halaman=<?php echo $i ?>&id=<?php echo $id?>"><?php echo $i ?></a>
                                            </li>
                                            <?php
                                        } else {
                                            ?>
                                            <li class="page-item active"><a class="page-link"><?php echo $i ?></a>
                                            </li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
                <button class="btn btn-primary" type="button" style="margin-right: 40px;margin-top: 20px;" onclick="window.history.back()">Kembali
                </button></div>
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