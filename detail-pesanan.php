<?php include_once("functions.php"); ?>
<?php
session_start();
$username = $_SESSION['nama'];
$idpes = $_GET['idpes'];
$nama = $_GET['nama'];
$meja = $_GET['meja'];
$status = $_GET['status'];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Detail Pesanan - Broto</title>
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
                <h3 class="text-dark mb-4">Detail Pesanan</h3>
                <form name="f" method="post" action="proses/proses-edit-detail-pesanan.php" onsubmit="return validdasiData()">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                                class="fa fa-envelope"></i></span></div>
                                <input type="text" class="form-control" placeholder="Nomor Pesanan" name="idpes"
                                       required readonly value="<?php echo $idpes; ?>"></div>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                                class="fa fa-user"></i></span></div>
                                <input type="text" class="form-control" placeholder="Pemesan" name="nama"
                                       readonly required value="<?php echo $nama; ?>"></div>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                                class="fa fa-table"></i></span></div>
                                <input type="text" class="form-control" placeholder="Nomor Meja" name="meja"
                                       required readonly value="<?php echo $meja; ?>">
                                <input type="hidden" name="status" value="<?php echo $status; ?>"></div>
                            <?php
                            if ($_SESSION['jabatan'] == "Pelayan" and $status != 'Dibayar') {
                                ?>
                                <div class="row" style="margin-left: 20px;margin-right: 40px;">
                                    <div class="col" style="width: 500px;">
                                        <div class="field" style="margin-left: 0;"><select class="form-control"
                                                                                           name="menu">
                                                <optgroup label="Pilih Menu">
                                                    <?php
                                                    $datakategori = getMenu();
                                                    foreach ($datakategori as $data) {
                                                        echo "<option value=\"" . $data["id_menu"] . "\">" . $data["nama_menu"] . "</option>";
                                                    }
                                                    ?>
                                                </optgroup>
                                            </select>
                                            <label
                                                    class="mb-0" for="float-input">Pilih Menu</label>
                                        </div>
                                    </div>
                                    <div class="col" style="margin-left: 0;">
                                        <div class="input-group" style="margin-top: 20px;">
                                            <div class="input-group-prepend"><span
                                                        class="input-group-text icon-container"><i
                                                            class="fa fa-align-justify"></i></span></div>
                                            <input type="number" class="form-control" placeholder="Jumlah" name="jumlah"
                                                   required></div>
                                    </div>
                                    <div class="col">
                                        <button class="btn btn-primary" type="submit" name="TblDetail"
                                                style="margin-top: 20px;">Tambah
                                        </button>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                </form>
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table dataTable my-0" id="dataTable">
                        <thead>
                        <tr>
                            <th>Menu</th>
                            <th>Jumlah Beli</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $datadetail = getDetailMenu($idpes);
                        foreach ($datadetail as $data) {
                            ?>
                            <tr>
                                <td><?php echo $data["nama_menu"]; ?></td>
                                <td><?php echo $data["jumlah"]; ?></td>
                                <?php if ($status != 'Dibayar' AND $_SESSION['jabatan']=='Pelayan') {
                                    ?>
                                    <td class="text-center"><a
                                                href="proses/proses-hapus-pesanan-detail.php?idMenu=<?php echo $data["id_menu"]; ?>&id=<?php echo $data['id_pesanan']; ?>&idpes=<?php echo $idpes; ?>&nama=<?php echo $nama; ?>&meja=<?php echo $meja; ?>&status=<?php echo $status; ?>">Hapus</a>
                                    </td>
                                    <?php
                                }
                                ?>
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
                <form name="k" method="post" action="proses/proses-edit-pesanan.php">
                    <div class="field"><select class="form-control" name="status" required>
                            <optgroup label="Pilih Status Pesanan">
                                <?php
                                if ($status == 'Pending') {
                                    ?>
                                    <option value="Pending" selected="selected">Pending</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Dimasak">Dimasak</option>
                                    <option value="Dibayar">Dibayar</option>
                                    <option value="Reservasi">Reservasi</option>
                                    <?php
                                } else if ($status == 'Selesai') {
                                    ?>
                                    <option value="Pending">Pending</option>
                                    <option value="Selesai" selected>Selesai</option>
                                    <option value="Dimasak">Dimasak</option>
                                    <option value="Dibayar">Dibayar</option>
                                    <option value="Reservasi">Reservasi</option>
                                    <?php
                                } else if ($status == 'Dimasak') {
                                    ?>
                                    <option value="Pending">Pending</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Dimasak" selected>Dimasak</option>
                                    <option value="Dibayar">Dibayar</option>
                                    <option value="Reservasi">Reservasi</option>
                                    <?php
                                } else if ($status == 'Dibayar') {
                                    ?>
                                    <option value="Dibayar" selected>Dibayar</option>
                                    <?php
                                } else if ($status == 'Reservasi') {
                                    ?>
                                    <option value="Pending">Pending</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Dimasak">Dimasak</option>
                                    <option value="Dibayar">Dibayar</option>
                                    <option value="Reservasi" selected>Reservasi</option>
                                    <?php
                                }
                                ?>
                            </optgroup>
                        </select>
                        <label
                                class="mb-0" for="float-input">Status Pesanan</label>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $idpes; ?>">
                    <input type="hidden" name="meja" value="<?php echo $meja; ?>">
                    <input type="hidden" name="statusawal" value="<?php echo $status; ?>">
                    <button class="btn btn-primary" type="submit" name="TblUpdate">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<footer class="bg-white sticky-footer">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © RamenKu2019</span></div>
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
<SCRIPT>
    function validdasiData() {
        var angka= document.f.jumlah.value;
        if(isNaN(angka) || angka.length==0 || angka<1){
            alert("Masukkan Jumlah Pesanan Yang Valid!");
            return false;
        }
        return true;
    }
</SCRIPT>
</body>

</html>