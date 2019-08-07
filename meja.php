<?php include_once("functions.php"); ?>
<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: login.php");
}
$username = $_SESSION["nama"];
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Brand</title>
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
        showError("Meja Telah Ada!.");
    else if ($error == 2)
        showError("Error database. Silahkan hubungi administrator");
    else if ($error == 3)
        showError("Koneksi ke Database gagal. Autentikasi gagal.");
    else if ($error == 4)
        showError("Anda tidak boleh mengakses halaman sebelumnya karena anda bukan koki!.");
    else
        showError("Unknown Error.");
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
        <div id="content" style="/*float: left;*/">
            <?php topBar($username); ?>
            <div class="container-fluid">
                <h3 class="text-dark mb-4">Meja</h3>
            </div>
            <?php
            $count = 1;
            $meja = getMeja();
            foreach ($meja as $data) {
                if ($count % 4 == 1) {
                    ?>
                    <div class="row" style="margin-right: 40px;margin-left: 20px;margin-top: 20px;">
                    <?php
                }//endifcount
                ?>
                <div class="col"><a
                            href="edit-meja.php?id=<?php echo $data['no_meja']; ?>&kursi=<?php echo $data['jumlah_kursi']; ?>&status=<?php echo $data['Status']; ?>">
                        <button class="btn btn-primary" type="button"
                                style="float: left;/*align-content: center;*/background-color: <?php if ($data['Status'] == 'Kosong') {
                                    echo "rgb(78,223,84);";
                                } else {
                                    echo "rgb(223,78,78);";
                                } ?>margin-right: 5px;">
                            <?php echo "Meja " . $data['no_meja'] ?>
                        </button>
                    </a>
                    <h3 class="text-dark mb-4" style="margin-top: 10px;"><?php echo $data['jumlah_kursi']; ?> Kursi</h3>
                </div>
                <?php
                if ($count % 4 == 0) {
                    ?>
                    </div>
                    <?php
                }//endifcount
                $count++;
            }//endforeach
            if ($count % 4 != 1){
            ?>
        </div>
        <?php
        }
        ?>
        <a href="tambah-meja.php">
            <button class="btn btn-primary" type="button" style="margin-right: 40px;margin-top: 20px;">Tambah
                Data
            </button>
        </a>
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
</body>

</html>