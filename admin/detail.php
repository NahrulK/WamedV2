<h2>Detail Pembelian </h2>

<?php

$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pelanggan = '$_GET[id_pelanggan]'");

$ambil_total =  $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian = '$_GET[id_pembelian]'"); 
$array_total = $ambil_total->fetch_assoc(); 
$pertotal = $array_total['total_pembelian']; 
$tanggal_pembelian =  $array_total['tanggal_pembelian']; 

$detail = $ambil->fetch_assoc();

?>

<!-- <pre><?php //print_r($detail); ?></pre> -->

<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
<p>
    <?php echo $detail['telepon_pelanggan']; ?> <br>
    <?php echo $detail['email_pelanggan']; ?> <br>
</p>

<p>
    Tanggal :<?php echo $tanggal_pembelian; ?> <br>
    Totall :Rp. <?php echo number_format($pertotal); ?> <br>
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

        <?php $ambil =  $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk = produk.id_produk WHERE pembelian_produk.id_pembelian = '$_GET[id_pembelian]'"); ?>
        <?php $nomor = 1; ?>
        <?php while($pecah= $ambil->fetch_assoc()){ ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_produk'];?></td>
            <td>Rp. <?php echo number_format($pecah['harga_produk']);?></td>
            <td><?php echo $pecah['jumlah']; ?></td>
            <td>
                Rp. <?php echo number_format($pecah['harga_produk']*$pecah['jumlah']); ?>
            </td>
        </tr>
        <?php $nomor++;?>
        <?php } ?>
    </tbody>
</table>