<h2>Pelanggan</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama</td>
            <td>Email</td>
            <td>Telepon</td>
            <td>Aksi</td>
        </tr>
    </thead>
    <tbody>
        <?php $nomor = 1; ?>
        <?php $ambil = $koneksi->query("SELECT * FROM pelanggan"); ?>
        <?php while($pecah = $ambil->fetch_assoc()) { ?>

        <tr>
            <td><?php echo $nomor; ?></td>
            <td><?php echo $pecah['nama_pelanggan']; ?></td>
            <td><?php echo $pecah['email_pelanggan']; ?></td>
            <td><?php echo $pecah['telepon_pelanggan']; ?></td>
            <td>
                <a href="index.php?halaman=hapuspelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" class="btn btn-danger">Hapus</a>
                <a href="index.php?halaman=ubahpelanggan&id=<?php echo $pecah['id_pelanggan']; ?>" class="btn btn-warning">Ubah</a>
            </td>
        </tr>
        <?php $nomor++; ?>
        <?php } ?>
    </tbody>
</table>
<a href="index.php?halaman=tambahpelanggan" class="btn btn-primary">Tambah Pelanggan</a>