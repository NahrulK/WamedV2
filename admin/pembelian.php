<h2>Pembelian</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <td>Nomor</td>
            <td>Nama Pelanggan</td>
            <td>Total</td>
            <td>Tanggal</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1;?>
        <?php $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan = pelanggan.id_pelanggan"); ?>
    
        <?php while($pecah = $ambil->fetch_assoc()) { ?>
        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_pelanggan']; ?></td>
            <td><?php echo $pecah['total_pembelian']; ?></td>
            <td><?php echo $pecah['tanggal_pembelian']; ?></td>
            <td>
                <a href="index.php?halaman=detail&id_pembelian=<?php echo $pecah['id_pembelian']; ?>&id_pelanggan=<?php echo $pecah['id_pelanggan']; ?> " class="btn btn-info">Detail</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>