<?php include_once("functions.php"); ?>
<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: login.php");
}
if (!isset($_SESSION["jabatan"]) == "Pantry") {
    header("Location: bahan-baku.php?halaman=1");
}
$username = $_SESSION["nama"];
$id = getName(5);

if (strlen(isset($_SESSION["idBel"])) == 0) {

    $_SESSION["idBel"] = $id;
} else {
    $id = $_SESSION['idBel'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Tambah Data Belanja</title>
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
<?php
if (isset($_GET["error"])) {
    $error = $_GET["error"];
    if ($error == 1)
        showError("Anda belum memilih bahan baku apapun!.");
}
?>
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
                <h3 class="text-dark mb-1">Tambah Belanja<br></h3>
            </div>
            <form name="f" method="post" action="proses/proses-tambah-belanja.php">
                <div class="input-group" style="margin-left: 20px;margin-top: 20px;">
                    <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                    class="fa fa-align-justify"></i></span></div>
                    <input type="text" class="form-control" placeholder="ID Belanja" style="margin-right: 60px;" name="id" readonly value="<?php echo $id;?>"></div>
                <h3 class="text-dark mb-1" style="margin-left: 20px;">Tanggal Belanja<br></h3><input type="date"
                                                                                                     style="margin-left: 20px;margin-bottom: 20px;" name="tanggal" required
                    <?php
                    if(strlen(isset($_SESSION['tanggal'])) !=0){
                        echo " value='".$_SESSION['tanggal']."' readonly";
                    }
                    ?>>
                <div class="row" style="margin-left: 20px;margin-right: 40px;">
                    <div class="col" style="width: 500px;">

                        <div class="field" style="margin-left: 0;"><select class="form-control" name="bahan" required>
                                <optgroup label="Pilih Bahan Baku">
                                    <?php
                                    $databahan=getBahan($id);
                                    foreach ($databahan as $item){
                                        ?>
                                    <option value="<?php echo $item['id_bahan_baku']?>"><?php echo $item['nama_bahan']?></option>
                                    <?php
                                    }
                                    ?>
                                </optgroup>
                            </select>
                            <label
                                    class="mb-0" for="float-input">Pilih Bahan Baku</label>
                        </div>

                    </div>
                    <div class="col" style="margin-left: 0;">
                        <div class="input-group" style="margin-top: 20px;">
                            <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                            class="fa fa-align-justify"></i></span></div>
                            <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" required></div>
                    </div>

                    <div class="col">
                        <button class="btn btn-primary" type="submit" style="margin-top: 20px;">Tambah</button>
            </form>
        </div>
    </div>
    <div class="card shadow" style="margin-top: 20px;margin-right: 40px;margin-left: 20px;">
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <table class="table dataTable my-0" id="dataTable">
                    <thead>
                    <tr>
                        <th>Bahan Baku</th>
                        <th>Jumlah</th>
                        <th>Pilihan</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $datakategori = getListDetailBelanja($id);
                    foreach ($datakategori as $data) {
                        $total=$data['total_biaya'];
                        ?>
                        <tr>
                            <td><?php echo $data['nama_bahan']; ?></td>
                            <td><?php echo $data['jumlah_beli'] . " " . $data['satuan']; ?></td>
                            <td><a href="proses/proses-hapus-detail-belanja.php?idbahan=<?php echo $data['id_bahan_baku']; ?>&id=<?php echo $id; ?>&jumlah=<?php echo $data['jumlah_beli'];?>">Hapus</a> </td>
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
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text icon-container"
                                                       style="width: 145px;"><label>Total Harga Belanja</label></span>
                </div>
                <input type="number" class="form-control" placeholder="Total" value="<?php echo $total;?>" style="height: 45px;" readonly></div>
        </div>
    </div>
    <form name="k" method="post" action="proses/proses-simpan-belanja.php">
        <input type="hidden" name="idBel" value="<?php echo $id;?>">
        <button class="btn btn-primary" type="submit" style="margin-right: 40px;margin-top: 20px;">Simpan</button>
    </form></div>
<footer class="bg-white sticky-footer">
    <div class="container my-auto">
        <div class="text-center my-auto copyright"><span>Copyright © RamenKu 2019</span></div>
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