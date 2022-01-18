<h2>Detail Pembelian </h2>

<?php

$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan WHERE pembelian.id_pelanggan = '$_GET[id]'");

$detail = $ambil->fetch_assoc();

?>

<strong><?php echo $detail['nama_pelanggan']; ?></strong><br>
<p>
    <?php echo $detail['telepon_pelanggan']; ?> <br>
    <?php echo $detail['email_pelanggan']; ?> <br>
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