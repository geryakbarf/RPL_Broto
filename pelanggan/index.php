<?php
include_once "functions.php";
$datakuis = getListKuisioner();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
    <title>Home - Brand</title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic"
          rel="stylesheet">
    <link href="assets/css/styles.min.css" rel="stylesheet">
</head>

<body id="page-top">
<?php
if (isset($_GET["error"])) {
    $error = $_GET["error"];
    if ($error == 1)
        showError("Anda Sudah Menjawab Kuisioner tersebut dengan Nomor Pembayaran Yang sama!");
    else if ($error == 2)
        showError("Error database. Silahkan hubungi administrator");
    else if ($error == 3)
        showError("Koneksi ke Database gagal. Autentikasi gagal.");
}
?>
<nav class="navbar navbar-light navbar-expand" id="sidebar-wrapper">
    <div class="container">

    </div>
</nav>
<header class="d-flex masthead" style="background-image:url('assets/img/bg-masthead.jpg');">
    <div class="container my-auto text-center">
        <h1 class="mb-1">Portal Kuisioner</h1>
        <h3 class="mb-5"></h3><a class="btn btn-primary btn-xl js-scroll-trigger" href="#about" role="button">Isi
            Kuisioner</a>
        <div class="overlay"></div>
    </div>
</header>
<section class="content-section bg-light" id="about">
    <div class="container text-center">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <form name="f" method="post" action="proses/proses-tambah-kuisioner.php" onsubmit="return validdasiData()">
                    <div class="field"><select class="form-control" name="pertanyaan">
                            <optgroup label="Pilih Pertanyaan">
                                <?php
                                foreach ($datakuis as $data){
                                    ?>
                                <option value="<?php echo $data['id_kuis'];?>"><?php echo $data['isi_kuis'];?></option>
                                <?php
                                }
                                ?>
                            </optgroup>
                        </select>
                        <label
                                class="mb-0" for="float-input">Pilih Pertanyaan</label>
                    </div>
                <div class="input-group">
                    <div class="input-group-prepend"><span class="input-group-text">Nomor Pembayaran Anda</span></div>
                    <input class="form-control" type="text" maxlength="5" name="nopem" id="nopem" required>
                    <div class="input-group-append"></div>
                </div>
                <div class="input-group" style="margin-top: 20px;height: 150px;">
                    <div class="input-group-prepend"><span class="input-group-text">Jawaban Anda</span></div>
                    <textarea class="form-control" name="jawaban" id="jawaban" readonly required></textarea>
                    <div class="input-group-append"></div>
                </div>
                <button class="btn btn-dark btn-xl js-scroll-trigger" role="button"
                   style="margin-top: 20px;" type="submit">Kirim Kuisioner</button></form></div>
        </div>
    </div>
</section>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
<script src="assets/js/script.min.js"></script>
<script language="JavaScript">
    $(function () {
        $("#nopem").on('input', function () {
            var nopem = $(this).val();
            $("#jawaban").val("");
            $.ajax({
                url: "proses/proses-request-nopem.php",
                type: "GET",
                data: {nopem: nopem},
                success: function (data) {
                    var resp = JSON.parse(data);
                    if (resp.status == "OK") {
                        $("#jawaban").val("");
                        $("#jawaban").attr("readonly", false);
                    }else{
                        $("#jawaban").val("Nomor Pembayaran Tidak Valid!");
                        $("#jawaban").attr("readonly", true);}
                }
            });
        });
    })
</script>
<script language="JavaScript">
    function validdasiData() {
        var jawaban= document.f.jawaban.value;
        if(jawaban == "Nomor Pembayaran Tidak Valid!"){
            return false;
        }
        return true;
    }
</script>
</body>

</html>