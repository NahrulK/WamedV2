<?php session_start(); ?>
<?php
//koneksi ke database
include "koneksi.php";
?>
<?php

$id_produk = $_GET['id']; //Ambil id produk yg ada di url
// Mengambil file dari table produk di database
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$detail = $ambil->fetch_assoc(); // memecah var ambil ke array

?>

<pre><?php print_r($detail) ?></pre>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warung Media</title>
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

    <!-- Konten -->
    <section class="konten">
        <div class="container">
           <div class="row">
               <div class="col-md-6">
                   <img src="foto_produk/<?php echo $detail['foto_produk']; ?>" class='img-responsive' width="80%" alt="">
               </div>
               <div class="col-md-6">
                   <h2><?php echo $detail['nama_produk']; ?></h2>
                   <h4>Rp. <?php echo number_format($detail['harga_produk']); ?></h4>
                   <form method="post">
                       <div class="form-group">
                           <div class="input-group">
                               <input type="number" min="1" class="form-control" name="jumlah">
                               <div class="input-group-btn">
                                   <button class="btn btn-primary" name="beli">Beli</button>
                               </div>
                           </div>
                       </div>
                   </form>

                    <?php
                    
                    if(isset($_POST['beli']))
                    {
                        //Mendapatkan jumlah yg di inptkan
                        $jumlah = $_POST['jumlah'];
                        // memasukan variable jumlah kedalam keranjang
                        $_SESSION['keranjang'][$id_produk] = $jumlah;

                        echo "<script>alert('produk telah dimasukan ke keranjang')</script>";
                        echo "<script>location='keranjang.php';</script>";
                    }
                    
                    ?>

                   <p><?php echo $detail['deskripsi_produk']; ?></p>
               </div>
           </div>
        </div>
    </section>
    
</body>
</html>