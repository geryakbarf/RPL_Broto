<?php include_once("functions.php"); ?>
<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: login.php");
}
$username = $_SESSION["nama"];
$keyword=$_POST['keyword'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Reservasi - Broto</title>
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
                    <button class="btn btn-primary" type="button" onclick="window.history.back()">Kembali</button>

                <h3 class="text-dark mb-4">Reservasi</h3>
                <div class="card shadow">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-nowrap">
                                <div id="dataTable_length" class="dataTables_length" aria-controls="dataTable"></div>
                            </div>
                            <div class="col-md-6">

                            </div>
                        </div>
                        <div class="table-responsive table mt-2" id="dataTable" role="grid"
                             aria-describedby="dataTable_info">
                            <table class="table dataTable my-0" id="dataTable">
                                <thead>
                                <tr>
                                    <th>Nomor Reservasi</th>
                                    <th>Tanggal Reservasi</th>
                                    <th>Nama Pemesan</th>
                                    <th class="text-center">Nomor Meja</th>
                                    <th class="text-center">Pilihan</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $db = dbConnect();
                                $batas = 20;
                                $halaman = $_GET['halaman'];
                                if (empty($halaman)) {
                                    $posisi = 0;
                                    $halaman = 1;
                                } else {
                                    $posisi = ($halaman - 1) * $batas;
                                }
                                if ($db->connect_errno == 0) {
                                    $count = $db->query("SELECT reservasi.id_reservasi, reservasi.tanggal, pesanan.nama_pelanggan, pesanan.no_meja, pesanan.id_pesanan 
                                                        FROM reservasi JOIN pesanan ON reservasi.id_reservasi=pesanan.id_reservasi WHERE reservasi.id_reservasi LIKE '%$keyword%' OR pesanan.no_meja='$keyword' OR reservasi.tanggal LIKE '%$keyword%' OR pesanan.nama_pelanggan LIKE '%$keyword%' ORDER BY reservasi.tanggal DESC");
                                    $res = $db->query("SELECT reservasi.id_reservasi, reservasi.tanggal, pesanan.nama_pelanggan, pesanan.no_meja, pesanan.id_pesanan 
                                                        FROM reservasi JOIN pesanan ON reservasi.id_reservasi=pesanan.id_reservasi WHERE reservasi.id_reservasi LIKE '%$keyword%' OR pesanan.no_meja='$keyword' OR reservasi.tanggal LIKE '%$keyword%' OR pesanan.nama_pelanggan LIKE '%$keyword%' ORDER BY reservasi.tanggal DESC LIMIT $posisi,$batas ");
                                    if ($res) {
                                        $jmldata = mysqli_num_rows($count);
                                        $jmlhalaman = ceil($jmldata / $batas);
                                        $datajadwal = $res->fetch_all(MYSQLI_ASSOC);
                                        foreach ($datajadwal as $data) {
                                            ?>
                                            <tr>
                                                <td><?php echo $data["id_reservasi"]; ?></td>
                                                <td><?php echo $data["tanggal"]; ?></td>
                                                <td><?php echo $data["nama_pelanggan"]; ?></td>
                                                <td class="text-center"><?php echo $data["no_meja"]; ?></td>
                                                <td class="text-center"><a
                                                            href="detail-reservasi.php?idres=<?php echo $data["id_reservasi"]; ?>&tanggal=<?php echo $data["tanggal"]; ?>&nama=<?php echo $data["nama_pelanggan"]; ?>&meja=<?php echo $data["no_meja"]; ?>">Detail</a>
                                                </td>
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
                                                                         href="reservasi.php?halaman=<?php echo $i ?>"><?php echo $i ?></a>
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
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © RamenKu2019</span></div>
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
<script>
    $(document).ready(function () {
        $('#f').keydown(function () {
            var keyword = $("#keyword").val();
            var key = e.which;
            if (key == 13) {
                $('#f').submit();
            }
        });
    });
</script>
</body>

</html>