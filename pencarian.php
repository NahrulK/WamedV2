<?php

//koneksi ke database
include "koneksi.php";

// menyiapkan variable
$keyword = $_GET['keyword'];
$semuadata = array();

$ambil = $koneksi->query("SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%' ");

while($pecah = $ambil->fetch_assoc())
{
    $semuadata[]=$pecah;
}

?>

<!-- <pre>
    <?php //print_r($semuadata); ?>
</pre> -->

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

    <?php include('menu.php'); ?>

    <section class="konten">
        <div class="container">
            <h1>Hasil Pencarian :  <?php echo $keyword; ?></h1>

            <?php if(empty($semuadata)) : ?>

                <div class="alert alert-danger">Produk <strong> <?php echo $keyword; ?> </strong> tidak ditemukan</div>

            <?php endif; ?>

            <div class="row">

            <?php foreach ($semuadata as $key => $perproduk) : ?>

                <div class="col-md-3">
                   <div class="thumbnail">
                   <img src="foto_produk/<?php echo $perproduk['foto_produk']; ?>" >
                   <div class="caption">
                       <h3><?php echo $perproduk['nama_produk']; ?></h3>
                       <h5>RP.  <?php echo number_format($perproduk['harga_produk']); ?></h5>
                       <a href="beli.php?id=<?php echo $perproduk['id_produk']; ?>" class="btn btn-primary">Beli</a>
                       <a href="detail.php?id=<?php echo $perproduk['id_produk'] ?>" class="btn btn-default">Detail</a>
                   </div>
                   </div>
                </div> 
                
                <?php endforeach; ?>
                
            </div>
        </div>
    </section>

</body>
</html>