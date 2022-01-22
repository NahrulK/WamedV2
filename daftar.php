<?php include('koneksi.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

<?php include('menu.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Daftar Akun
                    </h3>
                    <div class="panel-body">
                        <form action="" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label for="" class="control-label col-md-3"> Nama </label>
                                <div class="col-md-7">
                                    <input type="text" name="nama" id="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3"> Email</label>
                                <div class="col-md-7">
                                    <input type="email" name="email" id="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3">Password </label>
                                <div class="col-md-7">
                                    <input type="password" name="password" id="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3"> Alamat </label>
                                <div class="col-md-7">
                                    <textarea name="alamat" id="" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="control-label col-md-3"> Telp/Hp </label>
                                <div class="col-md-7">
                                    <input type="text" name="telepon" id="" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-7 col-md-offset-3">
                                    <button class="btn btn-primary" name="daftar" >Daftar</button>
                                </div>
                            </div>
                        </form>

                        <?php
                        // jika tombol daftar di klik
                        if(isset($_POST['daftar'])){

                        $nama = $_POST['nama'];
                        $email = $_POST['email'];
                        $alamat = $_POST['alamat'];
                        $telepon = $_POST['telepon'];
                        $password = $_POST['password'];

                        // Lakukan pengambilan tabel

                        $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email_pelanggan='$email'");
                        $yangcocok = $ambil->num_rows;

                         // Lakukakan pengecekak
                        if($yangcocok == 1) {

                            echo "<script>alert('akun sudah ada, silahkan gunakan email yg berbeda');</script>";
                            echo "<script>location='daftar.php';</script>";
                    
                        }else {

                            $koneksi->query("INSERT INTO pelanggan (
                                email_pelanggan,nama_pelanggan,password_pelanggan,alamat_pelanggan,telepon_pelanggan
                            ) VALUES ('$email','$nama','$password','$alamat','$telepon')");

                            echo "<script>alert('Anda berhasil mendaftarkan akun, Silahkan login');</script>";
                            echo "<script>location='login.php';</script>";

                        }
                       



                        }                                          
                                               
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>