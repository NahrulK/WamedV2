<?php


session_start();
include "koneksi.php";
if(!isset($_SESSION['pelanggan'])) {

    echo "<script>alert('Anda Harus Login');</script>";
    echo "<script>location='login.php';</script>";
    
    exit();
 
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>
    

<?php include('menu.php'); ?>

<section class="konten">

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
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $totalharga = 0; ?>
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
        </tr>
        <?php $nomor++; ?>
        <?php $totalharga += $subharga; ?>
       <?php endforeach; ?>
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4">Total Belanja</th>
            <th>Rp. <?php echo number_format($totalharga); ?></th>
        </tr>
    </tfoot>
</table>

<form action="" method="post">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" name="" id="" readonly value="<?php echo $_SESSION['pelanggan']['nama_pelanggan'] ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <input type="text" name="" id="" readonly value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan'] ?>" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <select name="id_ongkir" id="" class="form-control">
                    <option value="">Pilih Jasa.</option>
                <?php 
                $ambil = $koneksi->query("SELECT * FROM ongkir");
                while($perongkir = $ambil->fetch_assoc()) {
                ?>
                    <option value="<?php echo $perongkir['id_ongkir']; ?>"><?php echo $perongkir['nama_kota'] ?> Rp. <?php echo number_format($perongkir['tarif']); ?></option>                    
                <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <label >Alamat Lengkap Pengiriman</label>
    <textarea class="form-control" name="alamat_pengiriman" placeholder="Masukan alamat lengkap (termasuk kode post.)"></textarea><br>
    <button class="btn btn-primary" name="checkout">Checkout</button>

</form>
         
<?php

if(isset($_POST['checkout']))
{
    // mengumpulkan data kedalam variabel
    $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
    $id_ongkir = $_POST["id_ongkir"];
    $tanggal_pembelian = date("Y-m-d");
    $alamat_pengiriman = $_POST['alamat_pengiriman'];

    $ambil = $koneksi->query("SELECT * FROM ongkir WHERE id_ongkir='$id_ongkir'"); //ambil tabel ongkir
    $array_ongkir = $ambil->fetch_assoc(); // pecah tabel ongkir
    $tarif = $array_ongkir['tarif']; // ambil tabel tarif
    $nama_kota = $array_ongkir['nama_kota'];

    $total_pembelian = $totalharga + $tarif;

    // 1. Manyimpan data kedalam tabel pembelian
    $koneksi->query("INSERT INTO pembelian(
        id_pelanggan,id_ongkir,tanggal_pembelian,total_pembelian,nama_kota,tarif,alamat_pengiriman) VALUES ('$id_pelanggan','$id_ongkir','$tanggal_pembelian','$total_pembelian','$nama_kota','$tarif','$alamat_pengiriman') ");
    
    // 2. Mendapatkan total pembelian yang baru saja terjadi
    $id_pembelian_barusaja = $koneksi->insert_id;

    foreach($_SESSION["keranjang"] as $id_produk => $jumlah)
    {
        
        // mendapatkan data produk
        $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
        $perproduk = $ambil->fetch_assoc();

        $nama = $perproduk['nama_produk'];
        $harga = $perproduk['harga_produk'];
        $berat = $perproduk['berat_produk'];

        $subberat = $perproduk['berat_produk']*$jumlah;
        $subharga = $perproduk['harga_produk']*$jumlah;
                
        $koneksi->query("INSERT INTO pembelian_produk (id_pembelian,id_produk,nama,harga,berat,subberat,subharga,jumlah) VALUES ('$id_pembelian_barusaja','$id_produk','$nama','$harga','$berat','$subberat','$subharga','$jumlah') ");
    }

    // mengosongkan keranjang

    unset($_SESSION['keranjang']);

    // Mengalikan
    echo "<script>alert('Pembelian Berhasil');</script>";
    echo "<script>location='nota.php?id=$id_pembelian_barusaja&id_pelanggan=$id_pelanggan';</script>";

}

?>
        
    </div>

</section>

<!-- <pre><?php //print_r($_SESSION['pelanggan']); ?></pre> -->