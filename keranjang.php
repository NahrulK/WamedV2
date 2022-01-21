<?php

session_start();

//koneksi ke database
include "koneksi.php";

if(empty($_SESSION["keranjang"]) OR !isset($_SESSION['keranjang'])){

    echo "<script>alert('Silahkan belanja kembali.')</script>";
    echo "<script>location='index.php';</script>";

}



?>

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

<div class="konten">
    <div class="container">
        <h1>Keranjang Belanja</h1>
        <hr>
        <table class="table table-bordered">
    <thead>
        <tr>
            <td>No</td>
            <td>Produk</td>
            <td>Harga</td>
            <td>Jumlah</td>
            <td>Subharga</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php foreach ($_SESSION['keranjang'] as $id_produk => $jumlah) : ?>

            <!-- Menampilkan produk berdasarkan id -->
        <?php 
        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
        $pecah = $ambil->fetch_assoc();
        $subharga = $pecah['harga_produk'] * $jumlah;
        ?>

        <tr>
           <td><?php echo $nomor; ?></td>
           <td><?php echo $pecah['nama_produk']; ?></td>
           <td>Rp. <?php echo number_format($pecah['harga_produk']); ?></td>
           <td><?php echo $jumlah; ?></td>
           <td><?php echo number_format($subharga); ?></td>
           <td>
               <a href="hapuskeranjang.php?id=<?php echo $id_produk ?>" class="btn btn-danger btn-xs">Hapus</a>
           </td>
        </tr>
        <?php $nomor++; ?>
       <?php endforeach; ?>
    </tbody>
</table>

            <a href="index.php" class="btn btn-default">Lanjutkan Belaja</a>
            <a href="checkout.php" class="btn btn-primary">Checkout</a>

    </div>
</div>