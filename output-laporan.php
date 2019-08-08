<?php include_once("functions.php") ?>
<?php
session_start();
if (!isset($_SESSION["nip"]))
    header("Location: login.php");
$username = $_SESSION["nama"];
$jenis=$_POST['jenis'];
$periodik=$_POST['periodik'];
$tanggal=$_POST['tanggal'];
if($jenis=='Pendapatan'){
    $laporan='Daftar Pendapatan  ';
    $totjumlah='Total Jumlah Transaksi';
    $tot="Total Pendapatan";
}else{
    $laporan='Daftar Belanja  ';
    $totjumlah='Total Jumlah Belanja';
    $tot="Total Pengeluaran";
}
$total=0;
$i=0;
$db=dbConnect();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Resto Broto</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Icon-Input.css">
    <link rel="stylesheet" href="assets/css/select.css">
    <link rel="stylesheet" href="assets/css/Studious-selectbox.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body>
    <h1 class="text-center">Laporan <?php echo $jenis;?> Resto Broto</h1>
    <div class="card" style="margin-top: 20px;margin-right: 40px;margin-left: 40px;">
        <div class="card-body">
            <h4 class="card-title"><?php echo $laporan?> <?php echo $periodik?></h4>
            <h6 class="text-muted card-subtitle mb-2">Tanggal : <?php echo $tanggal;?></h6>
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info" style="margin-top: 20px;">
                <table class="table dataTable my-0" id="dataTable">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        if($jenis=='Pendapatan' and $periodik=='Bulanan'){
                        $sql="SELECT tanggal as tgl, total_bayar as sub FROM pembayaran WHERE MONTH(tanggal)=MONTH('$tanggal') AND YEAR(tanggal)=YEAR('$tanggal') ";
                        }else if($jenis=='Pengeluaran' and $periodik=='Bulanan'){
                            $sql="SELECT Tanggal as tgl, total_biaya as sub FROM data_belanja WHERE MONTH(Tanggal)=MONTH('$tanggal') AND YEAR(Tanggal)=YEAR('$tanggal') ";
                        }else if($jenis=='Pengeluaran' and $periodik=='Mingguan'){
                            $sql="SELECT Tanggal as tgl, total_biaya as sub FROM data_belanja WHERE MONTH(Tanggal)=MONTH('$tanggal') AND YEAR(Tanggal)=YEAR('$tanggal') AND WEEK(Tanggal)=WEEK('$tanggal') ";
                        }else if($jenis=='Pendapatan' and $periodik=='Mingguan'){
                            $sql="SELECT tanggal as tgl, total_bayar as sub FROM pembayaran WHERE MONTH(tanggal)=MONTH('$tanggal') AND YEAR(tanggal)=YEAR('$tanggal') AND WEEK(tanggal)=WEEK('$tanggal')";
                        }

                        $res=$db->query($sql);
                        if(mysqli_num_rows($res)>0){
                            $data=$res->fetch_all(MYSQLI_ASSOC);
                            $res->free();
                            foreach ($data as $datum){
                                ?>
                                <tr>
                            <td><?php echo substr($datum['tgl'],0,10);?></td>
                                <td>Rp.<?php echo $datum['sub'];?></td>
                                </tr>
                    <?php
                            $total=$total+$datum['sub'];
                            $i=$i+1;
                            }
                        }
                    ?>
                        <tr>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td>Total</td>
                            <td>Rp.<?php echo $total;?></td>

                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>

                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><?php echo $totjumlah?></span></div><input class="form-control" readonly value="<?php echo $i;?>" type="number">
                <div class="input-group-append"></div>
            </div>
            <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><?php echo $tot?></span></div><input readonly class="form-control" type="text" value="Rp.<?php echo $total ?>">
                <div class="input-group-append"></div>
            </div>
        </div>
    </div><a href="index.php"><button class="btn btn-primary" type="button" style="margin-right: 40px;">Cetak Laporan</button></a>
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