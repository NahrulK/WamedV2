<?php $koneksi = new mysqli("localhost", "root", "", "wamedv2"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
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


<section class="konten">
    <div class="container">

    <h2>Detail Pembelian </h2>

<?php

$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pelanggan = '$_GET[id_pelanggan]'");

$detail = $ambil->fetch_assoc();

?>

<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
<p>
    <?php echo $detail['telepon_pelanggan']; ?> <br>
    <?php echo $detail['email_pelanggan']; ?> <br>
</p>

<p>
    Tanggal :<?php echo $detail['tanggal_pembelian']; ?> <br>
    Totall :<?php echo $detail['total_pembelian']; ?> <br>
</p>

<table class="table table-bordered">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Produk</td>
            <td>Harga</td>
            <td>Jumlah</td>
            <td>Subtotal</td>
        </tr>
    </thead>
    <tbody>

        <?php $ambil =  $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk = produk.id_produk WHERE pembelian_produk.id_pembelian = '$_GET[id]'"); ?>
        <?php $nomor = 1; ?>
        <?php while($pecah= $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_produk'];?></td>
            <td><?php echo $pecah['harga_produk'];?></td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td>
                <?php echo $pecah['harga_produk']*$pecah['jumlah']; ?>
            </td>
        </tr>
        <?php $nomor++;?>
        <?php } ?>
    </tbody>
</table>

<div class="row">
    <div class="col-md-7">
        <div class="alert alert-info">
            <p>Silahkan Melakukan pembayaran sebanyak Rp. <?php echo number_format($detail['total_pembelian']); ?> ke <br> <strong>BANK BRI 135-9866788-9987 AN. Warung Media</strong></p>
        </div>
    </div>
</div>


    </div>
</section>
    
</body>
</html>