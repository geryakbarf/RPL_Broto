<?php include_once("functions.php"); ?>
<?php
session_start();
if (!isset($_SESSION["nip"])) {
    header("Location: login.php");
}
$username = $_SESSION["nama"];
$id = getName(5);
$tanggal = date("Y-m-d H:i:s", strtotime('+5 hours'));
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
                <h3 class="text-dark mb-1">Tambah Pembayaran</h3>
            </div>
            <div class="card" style="margin-right: 40px;margin-left: 20px; margin-bottom: 20px">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                 aria-describedby="dataTable_info">
                                <table class="table dataTable my-0" id="tablepesanan">
                                    <thead>
                                    <tr>
                                        <th>Nama Menu</th>
                                        <th>Jumlah</th>
                                        <th>Sub Total</th>
                                    </tr>
                                    </thead>
                                    <tbody id="tbody">

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
                        <div class="col">
                            <div class="input-group" style="margin-top: 20px;">
                                <div class="input-group-prepend"><span class="input-group-text">Nomor Pembayaran</span>
                                </div>
                                <form name="f" method="post" action="proses/proses-tambah-pembayaran.php">
                                <input class="form-control" type="text" name="idPem" readonly
                                       value="<?php echo $id; ?>">
                                <div class="input-group-append"></div>
                            </div>
                            <div class="field"><select class="form-control" name="pesanan" required id="pesanan">
                                    <optgroup label="Pilih Nomor Pesanan">
                                        <?php
                                        $pesanan = getPesanan();
                                        foreach ($pesanan as $data) {
                                            ?>
                                            <option value="<?php echo $data['id_pesanan']; ?>"><?php echo $data['id_pesanan']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </optgroup>
                                </select>
                                <label
                                        class="mb-0" for="float-input">Pilih Nomor Pesanan</label>
                            </div>
                            <div class="input-group" style="margin-top: 20px;">
                                <div class="input-group-prepend"><span class="input-group-text">Tanggal</span></div>
                                <input class="form-control" type="text" readonly required name="tanggal"
                                       value="<?php echo $tanggal ?>">
                                <div class="input-group-append"></div>
                            </div>
                            <div class="input-group" style="margin-top: 20px;">
                                <div class="input-group-prepend"><span class="input-group-text">Sub Total</span></div>
                                <input class="form-control" type="number" readonly required name="subtotal"
                                       id="subtotal">
                                <div class="input-group-append"></div>
                            </div>
                            <div class="input-group" style="margin-top: 20px;">
                                <div class="input-group-prepend"><span class="input-group-text">Biaya Reservasi</span>
                                </div>
                                <input class="form-control" type="number" name="reservasi" id="reservasi" required
                                       readonly>
                                <div class="input-group-append"></div>
                            </div>
                            <div class="input-group" style="margin-top: 20px;">
                                <div class="input-group-prepend"><span class="input-group-text">Total Bayar</span></div>
                                <input class="form-control" type="number" name="total" id="total" required readonly>
                                <div class="input-group-append"></div>
                            </div>
                            <div class="input-group" style="margin-top: 20px;">
                                <div class="input-group-prepend"><span class="input-group-text">Bayar</span></div>
                                <input class="form-control" type="number" name="bayar" id="bayar" required>
                                <div class="input-group-append"></div>
                            </div>
                            <div class="input-group" style="margin-top: 20px;">
                                <div class="input-group-prepend"><span class="input-group-text">Kembalian</span></div>
                                <input class="form-control" type="text" name="kembalian" id="kembalian" required
                                       readonly>
                                <div class="input-group-append"></div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" name="TblSimpan" style="margin-top: 20px;">Simpan dan Cetak</button></form>
                </div>
            </div>
        </div>
        <footer class="bg-white sticky-footer">
            <div class="container my-auto">
                <div class="text-center my-auto copyright"><span>Copyright © Brand 2019</span></div>
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
        var subtotal = 0;
        var reservasi = 0;
        var pesanan = $("#pesanan").val();
        $.ajax({
            url: "proses/proses-request-pesanan.php",
            type: "GET",
            data: {pesanan: pesanan},
            success: function (data) {
                var resp = JSON.parse(data);
                if (resp.status == "OK") {
                    for (var i = 0; i < resp.data.length; i++) {
                        $('#tablepesanan.table').append("<tr><td>" + resp.data[i].nama_menu + "</td><td>" + resp.data[i].jumlah + "</td><td>" + resp.data[i].total_harga + "</td></tr>");
                    }
                }
            }
        });

        $.ajax({
            url: "proses/proses-request-sub-total.php",
            type: "GET",
            data: {pesanan: pesanan},
            success: function (data) {
                var resp = JSON.parse(data);
                if (resp.status == "OK") {
                    $('#subtotal').val(resp.total);
                    subtotal = resp.total;
                }
            }
        });

        $.ajax({
            url: "proses/proses-request-harga-reservasi.php",
            type: "GET",
            data: {pesanan: pesanan},
            success: function (data) {
                var resp = JSON.parse(data);
                if (resp.status == "OK") {
                    $('#reservasi').val(resp.harga);
                    if (parseInt(resp.harga) < 1) {
                        $('#total').val(parseInt(subtotal));
                    } else {
                        reservasi = resp.harga;
                        $('#total').val(parseInt(subtotal) + parseInt(reservasi));
                    }
                }
            }
        });


    });
</script>
<script language="JavaScript">
    $(function () {
        $("#pesanan").change(function () {
            $("#tbody").empty();
            $('#bayar').val("");
            $('#kembalian').val("");
            var pesanan = $("#pesanan").val();
            var subtotal = 0;
            var reservasi = 0;
            $.ajax({
                url: "proses/proses-request-pesanan.php",
                type: "GET",
                data: {pesanan: pesanan},
                success: function (data) {
                    var resp = JSON.parse(data);
                    if (resp.status == "OK") {
                        for (var i = 0; i < resp.data.length; i++) {
                            $('#tablepesanan.table').append("<tr><td>" + resp.data[i].nama_menu + "</td><td>" + resp.data[i].jumlah + "</td><td>" + resp.data[i].total_harga + "</td></tr>");
                        }
                    }
                }
            });

            $.ajax({
                url: "proses/proses-request-sub-total.php",
                type: "GET",
                data: {pesanan: pesanan},
                success: function (data) {
                    var resp = JSON.parse(data);
                    if (resp.status == "OK") {
                        $('#subtotal').val(resp.total);
                        subtotal = resp.total;
                    }
                }
            });

            $.ajax({
                url: "proses/proses-request-harga-reservasi.php",
                type: "GET",
                data: {pesanan: pesanan},
                success: function (data) {
                    var resp = JSON.parse(data);
                    if (resp.status == "OK") {
                        $('#reservasi').val(resp.harga);
                        if (parseInt(resp.harga) < 1) {
                            $('#total').val(parseInt(subtotal));
                        } else {
                            reservasi = resp.harga;
                            $('#total').val(parseInt(subtotal) + parseInt(reservasi));
                        }

                    }
                }
            });


        });
    })
</script>
<script language="JavaScript">
    $(function () {
        $("#bayar").on('input', function () {
            var harga = $("#total").val();
            var bayar = $(this).val();
            if (parseInt(bayar) < parseInt(harga)) {
                $("#kembalian").val("Pembayaran Belum Cukup!");
            }else if(parseInt(bayar) > parseInt(harga)){
                $("#kembalian").val(parseInt(bayar)-parseInt(harga));
            }else if(parseInt(bayar) == parseInt(harga)){
                $("#kembalian").val(parseInt(bayar)-parseInt(harga));
            }

        });
    })
</script>
</body>

</html>