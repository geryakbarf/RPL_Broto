<?php include_once("functions.php"); ?>
<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: login.php");
}
if ($_SESSION["jabatan"]<>"Koki") {
    header("Location: kebutuhan.php?halaman=1");
}
$username = $_SESSION["nama"];
$id = getName(5);
if (strlen(isset($_SESSION["idKeb"])) == 0) {

    $_SESSION["idKeb"] = $id;
} else {
    $id = $_SESSION['idKeb'];
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

            <?php topBar($username) ?>
            <div class="container-fluid">
                <h3 class="text-dark mb-1">Tambah Kebutuhan<br></h3>
            </div>
            <div class="input-group" style="margin-left: 20px;margin-top: 20px;">
                <div class="input-group-prepend"><span class="input-group-text icon-container"><i
                                class="fa fa-align-justify"></i></span></div>
                <form name="f" method="post" action="proses/proses-tambah-kebutuhan.php"
                      onsubmit="return validdasiData()">
                    <input type="text" class="form-control" placeholder="ID Kebutuhan" style="margin-right: 60px;"
                           readonly name="id" value="<?php echo $id; ?>">
            </div>
            <div class="field" style="margin-left: 20px;margin-right: 40px;"><select class="form-control" name="menu"
                                                                                     required>
                    <optgroup label="Pilih Menu">
                        <?php
                        $menu = getMenu();
                        foreach ($menu as $datamenu) {
                            if ($datamenu['id_menu'] == $_SESSION['kebMenu']) {
                                ?>
                                <option value="<?php echo $datamenu['id_menu']; ?>"
                                        selected><?php echo $datamenu['nama_menu']; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $datamenu['id_menu']; ?>"><?php echo $datamenu['nama_menu']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </optgroup>
                </select>
                <label
                        class="mb-0" for="float-input">Kebutuhan Untuk Menu</label>
            </div>
            <div class="row" style="margin-left: 20px;margin-right: 40px;">
                <div class="col" style="width: 500px;">

                    <div class="field" style="margin-left: 0;"><select class="form-control" id="bahan" name="bahan" required>
                            <optgroup label="Pilih Bahan Baku">
                                <?php
                                $databahan = getListBahan($id);
                                foreach ($databahan as $data) {
                                    ?>
                                    <option value="<?php echo $data['id_bahan_baku']; ?>"><?php echo $data['nama_bahan']; ?></option>
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
                        <input type="number" class="form-control" placeholder="Jumlah" name="jumlah" maxlength="2"
                               required></div>
                    <input type="hidden" id="stok" name="stok">
                    <input type="hidden" id="namabahan" name="namabahan">
                </div>

                <div class="col">
                    <button class="btn btn-primary" type="submit" name="TblSimpan" style="margin-top: 20px;">Tambah
                    </button>
                    </form>
                </div>
            </div>
            <div class="card shadow" style="margin-top: 20px;margin-right: 40px;margin-left: 20px;">
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid"
                         aria-describedby="dataTable_info">
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
                            $datadetail = getListDetailKebutuhan($id);
                            foreach ($datadetail as $dataku) {
                                ?>
                                <tr>
                                    <td><?php echo $dataku['nama_bahan']; ?></td>
                                    <td><?php echo $dataku['jumlah'] . " " . $dataku['satuan']; ?></td>
                                    <td>
                                        <a href="proses/proses-hapus-detail-kebutuhan.php?idBah=<?php echo $dataku['id_bahan_baku']; ?>&idKeb=<?php echo $id; ?>&jumlah=<?php echo $dataku['jumlah'];?>">Hapus</a>
                                    </td>
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
                </div>
            </div>
            <form name="a" method="post" action="proses/proses-save.php">
                <button class="btn btn-primary" type="submit" style="margin-right: 40px;margin-top: 20px;">Simpan
                </button>
            </form>
        </div>
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
<script>
    $( document ).ready(function() {
        var idBahan=$("#bahan").val();
        $.ajax({
            url: "proses/proses-request-stok.php",
            type: "GET",
            data: {idBahan: idBahan},
            success: function (data) {
                var resp = JSON.parse(data);
                if (resp.status == "OK") {
                    $("#stok").val(resp.stok);
                    $("#namabahan").val(resp.nama);
                }
            }
        });

    });
</script>
<script language="JavaScript">
    $(function () {
        $("#bahan").change(function () {
            var idBahan=$("#bahan").val();
            // alert(idMenu);
            $.ajax({
                url: "proses/proses-request-stok.php",
                type: "GET",
                data: {idBahan: idBahan},
                success: function (data) {
                    var resp = JSON.parse(data);
                    if (resp.status == "OK") {
                       $("#stok").val(resp.stok);
                        $("#namabahan").val(resp.nama);
                    }
                }
            });


        });
    })
</script>
<SCRIPT>
    function validdasiData() {
        var angka = parseInt(document.f.jumlah.value);
        var stok = parseInt(document.f.stok.value);
        var nama = document.f.namabahan.value;
        if(angka > stok){
            alert("Stok Untuk Bahan Baku "+nama+" Kurang dari yang anda inginkan! "+ stok+" < "+angka);
            return false;
        }
        if (isNaN(angka) || angka.length == 0 || angka < 1) {
            alert("Masukkan Jumlah Yang Valid!");
            return false;
        }

        return true;
    }
</SCRIPT>
</body>

</html>