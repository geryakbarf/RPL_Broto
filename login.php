<?php include_once("functions.php");?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/Icon-Input.css">
    <link rel="stylesheet" href="assets/css/select.css">
    <link rel="stylesheet" href="assets/css/Studious-selectbox.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
	<script language="javascript">
	function validasiData(){
		
	}
	</script>
</head>

<body class="bg-gradient-primary">
<?php
if(isset($_GET["error"])){
    $error = $_GET["error"];
    if ($error == 1)
        showError("Username dan password tidak sesuai.");
    else if ($error == 2)
        showError("Error database. Silahkan hubungi administrator");
    else if ($error == 3)
        showError("Koneksi ke Database gagal. Autentikasi gagal.");
    else if ($error == 4)
        showError("Anda tidak boleh mengakses halaman sebelumnya karena belum login.
Silahkan login terlebih dahulu.");
    else
        showError("Unknown Error.");
}
?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9 col-lg-12 col-xl-10">
                <div class="card shadow-lg o-hidden border-0 my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-flex">
                                <div class="flex-grow-1 bg-login-image" style="background-image: url(&quot;assets/img/dogs/image3.jpg&quot;);"></div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h4 class="text-dark mb-4">Selamat Datang !</h4>
                                    </div>
                                    <form class="user" name="f" method="post" action="proses-login.php">
                                        <div class="form-group"><input class="form-control form-control-user" placeholder="Masukan Username Anda" name="username" required></div>
                                        <div class="form-group"><input class="form-control form-control-user" type="password" id="exampleInputPassword" placeholder="Password" name="password" required></div>
                                        <div class="form-group">
                                            
                                        </div><button class="btn btn-primary btn-block text-white btn-user" type="submit" name="TblLogin">Login</button>
                                        <hr>
                                        <hr>
                                    </form>
                                  
                                    <div class="text-center"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/Studious-selectbox.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>