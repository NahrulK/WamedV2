<h2>Ubah Produk</h2>

<?php

$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk= '$_GET[id]'");
$pecah = $ambil->fetch_assoc();

?>

<?php
$datakategori = array();

$ambil = $koneksi->query("SELECT * FROM kategori");
while($pecah_kategori = $ambil->fetch_assoc()){
    $datakategori[] = $pecah_kategori;
}
?>

<form  method="post"  enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Nama</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_produk']; ?>">
    </div>
    <div class="form-group">
        <label for="">Kategori</label>
        <select name="id_kategori" class="form-control">
            <option value="Pilih Kategori">Pilih Kategori</option>
            <?php foreach ($datakategori as $key => $value) : ?>
            <option value="<?php echo $value['id_kategori'] ?>" <?php if($pecah['id_kategori'] == $value['id_kategori']){ echo "selected"; } ?> ><?php echo $value['nama_kategori']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Harga (Rp)</label>
        <input type="number" class="form-control" name="harga" value="<?php echo $pecah['harga_produk']; ?>">
    </div>
    <div class="form-group">
        <label for="">Kualitas</label>
        <input type="number" class="form-control" name="berat"value="<?php echo $pecah['berat_produk']; ?>">
    </div> 
    <div class="form-group">
        <label for="">Stok</label>
        <input type="number" class="form-control" name="stok"value="<?php echo $pecah['stok_produk']; ?>">
    </div>    
    <div class="form-group">
        <img src="../foto_produk/<?php echo $pecah['foto_produk'] ?>" width="200px">
    </div>
    <div class="form-group">
        <label for="">foto</label>
        <input type="file" class="form-control" name="foto">
    </div>
    <div class="form-group">
        <label for="">Deskripsi</label>
        <textarea class="form-control" name="deskripsi" rows="10">
            <?php echo $pecah['deskripsi_produk']; ?>
        </textarea>
    </div>

    <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php


if(isset($_POST['ubah'])) {

    $namafoto = $_FILES['foto']['name'];
    $lokasifoto = $_FILES['foto']['tmp_name'];

    //jika photo dirubah
    if (!empty($lokasifoto)){
        move_uploaded_file($lokasifoto, "../foto_produk/$namafoto");

        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',foto_produk='$namafoto',deskripsi_produk='$_POST[deskripsi]',id_kategori='$_POST[id_kategori]', stok_produk = '$_POST[stok_produk]' WHERE id_produk='$_GET[id]'");

    }else {

        $koneksi->query("UPDATE produk SET nama_produk='$_POST[nama]',harga_produk='$_POST[harga]',berat_produk='$_POST[berat]',deskripsi_produk='$_POST[deskripsi]',id_kategori='$_POST[id_kategori]', stok_produk = '$_POST[stok]' WHERE id_produk='$_GET[id]'");

    }

    echo "<script>alert('Produk Berhasil Diubah');</script>";
    echo "<script>location='index.php?halaman=produk';</script>";
}


?>



