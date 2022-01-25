<h2>Kategori Produk</h2>
<hr>

<?php
$senmuakategori = array();
$ambil = $koneksi->query('SELECT * FROM kategori');

while($pecah = $ambil->fetch_assoc()){
    $senmuakategori[] = $pecah;
}

?>

<!-- <pre>
    <?php //print_r($senmuakategori); ?>
</pre> -->

<table class="table table-bordered">
    <tr>
        <td>No</td>
        <td>Kategori</td>
        <td>Aksi</td>
    </tr>
    <?php foreach ($senmuakategori as $key => $value) :?>
    <tr>          
        <td><?php echo $key+1;?></td>
        <td><?php echo $value['nama_kategori']; ?></td>
        <td>
            <a class="btn btn-primary">Ubah</a>
            <a class="btn btn-danger">Hapus</a>
        </td>
    </tr>
    <?php endforeach ?>
</table>