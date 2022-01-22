<?php
session_start();
include "koneksi.php";
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

<?php include('menu.php'); ?>
    
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

        // mebagi tujuan login
        echo "<script>alert('Anda berhasil login');</script>";
        if(isset($_SESSION["keranjang"]) OR !empty($_SESSION["keranjang"]))
        {
            echo "<script>location='checkout.php';</script>";
        }else {
            echo "<script>location='riwayat.php';</script>";
        }

    }else {
        // Pesan Gagal login
        echo "<script>alert('Anda Gagal login, perika kembali akun anda');</script>";
        echo "<script>location='login.php';</script>";
    }

}


?>


</body>
</html>