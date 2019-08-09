<?php include_once("functions.php"); ?>
<?php
session_start();
$username = $_SESSION['nama'];
$idres = $_GET['idres'];
$nama = $_GET['nama'];
$meja = $_GET['meja'];
$tanggal = $_GET['tanggal'];
$tgl = substr($tanggal, 0, 10);
$jam = date("H:i", strtotime($tanggal));
//$jam = substr($tanggal, 10, -3);
//getID
$db = dbConnect();
$sql = "SELECT id_pesanan,status FROM pesanan, reservasi WHERE pesanan.id_reservasi=reservasi.id_reservasi AND reservasi.id_reservasi='$idres'";
$res = $db->query($sql);
$data = $res->fetch_all(MYSQLI_ASSOC);
foreach ($data as $new) {
    $idpes = $new['id_pesanan'];
    $status = $new['status'];
}
//
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Table - Brand</title>
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
                <h3 class="text-dark mb-4">Detail Reservasi</h3>
                <form name="f" method="post" action="proses/proses-edit-detail-reservasi.php" onsubmit="return validdasiData()">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                                class="fa fa-envelope"></i></span></div>
                                <input type="text" class="form-control" placeholder="Nomor Reservasi" name="idres"
                                       required readonly value="<?php echo $idres; ?>">
                                <input type="hidden" name="idpes" value="<?php echo $idpes; ?>"></div>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                                class="fa fa-user"></i></span></div>
                                <input type="text" class="form-control" placeholder="Pemesan" name="nama"
                                       readonly required value="<?php echo $nama; ?>"></div>
                            <div class="input-group">

                                <input type="hidden" name="meja" value="<?php echo $meja; ?>">
                                <input type="hidden" name="status" value="<?php echo $status; ?>">
                                <input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">
                            </div>

                            <?php
                            if ($_SESSION['jabatan'] == "Pelayan" and $status == 'Reservasi') {
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
                            <th></th>
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
                                <?php if ($status == 'Reservasi') {
                                    ?>
                                    <td class="text-center"><a
                                                href="proses/proses-hapus-reservasi-detail.php?idMenu=<?php echo $data["id_menu"]; ?>&id=<?php echo $data['id_pesanan']; ?>&idpes=<?php echo $idpes; ?>&nama=<?php echo $nama; ?>&meja=<?php echo $meja; ?>&status=<?php echo $status; ?>&idres=<?php echo $idres; ?>&tanggal=<?php echo $tanggal; ?>">Hapus</a>
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
                            <td></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
                <form name="k" method="post" action="proses/proses-simpan-reservasi.php">
                    <h3 class="text-dark mb-4" style="margin-left: 20px;margin-bottom: 20px; margin-top: 0px">Tanggal
                        Reservasi</h3>
                    <div class="input-group" style="margin-left: 20px;margin-right: 20px;">
                        <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                        class="far fa-calendar-times"></i></span></div>
                        <input type="date" name="tanggal" value="<?php echo $tgl; ?>" required
                            <?php
                            if($status<>'Reservasi')echo " readonly"
                            ?>>
                        <input type="time" name="jam" value="<?php echo $jam; ?>" required <?php
                        if($status<>'Reservasi')echo " readonly"
                        ?>></div>
                    <div class="field" style="margin-left: 0;"><select class="form-control" name="meja">
                            <optgroup label="Nomor Meja">
                                <?php
                                $datameja = getListMeja();
                                if($status=='Reservasi'){
                                foreach ($datameja as $data) {
                                    if($data['no_meja']==$meja){
                                        ?>
                                        <option selected='selected' value="<?php echo $data['no_meja'];?>"><?php echo $data['no_meja'];?></option>
                                        <?php
                                    }else{
                                        ?>
                                        <option value="<?php echo $data['no_meja'];?>"><?php echo $data['no_meja'];?></option>
                                        <?php
                                    }
                                }
                                }
                                else{
                                    ?>
                                <option value="<?php echo $meja?>"><?php echo $meja?></option>
                                <?php
                                }
                                ?>
                            </optgroup>
                        </select>
                        <label
                                class="mb-0" for="float-input">Nomor Meja</label>
                    </div>
                    <div class="field"><select class="form-control" name="status" required>
                            <optgroup label="Pilih Status Pesanan">
                                <option value="<?php echo $status ?>"><?php echo $status ?></option>
                            </optgroup>
                        </select>
                        <label
                                class="mb-0" for="float-input">Status Pesanan</label>
                    </div>
                    <input type="hidden" name="idres" value="<?php echo $idres; ?>">
                    <input type="hidden" name="idpes" value="<?php echo $idpes?>">
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