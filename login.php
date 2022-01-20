<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "wamedv2");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<!-- NavBar -->
<nav class="navbar navbar-default">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="keranjang.php">Keranjang</a></li>
                
                <!-- jika sudah login -->
                <?php if(isset($_SESSION['pelanggan'])) : ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else : ?>
                <!-- Jika belum login -->
                    <li><a href="login.php">Logit</a></li>
                <?php endif; ?>


                <li><a href="checkout.php">Checkout</a></li>               
            </ul>          
        </div>
    </nav>
<!-- Closing NavBar -->
    
<div class="container">
    <div class="row">
        <div class="col-md-4">

            <div class="panel panel-default">
                
                <div class="panel-heading">
                    <h3 class="panel-title"> Login Pelanggan</h3>
                </div>

                <div class="panel-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <button class="btn btn-primary" name="simpan">Simpan</button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

<?php
// jika tombol simpan ditekan
if(isset($_POST["simpan"])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    // melakukan query mengeck akun di tabel pelanggan
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email' AND password_pelanggan ='$password'");

    // Ngitung akun yang terambil
    $akunyangcocok = $ambil->num_rows;

    // Jika akun cocok maka login
    if($akunyangcocok == 1) {

        //mengambil akun dalam bentuk array
        $akun = $ambil->fetch_assoc();
        //simpan di session pelanggan
        $_SESSION['pelanggan'] = $akun;

        echo "<script>alert('Anda berhasil login');</script>";
        echo "<script>location='checkout.php';</script>";

    }else {
        // Pesan Gagal login
        echo "<script>alert('Anda Gagal login, perika kembali akun anda');</script>";
        echo "<script>location='login.php';</script>";
    }

}


?>


</body>
</html>