<?php

$id_produk = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM produk LEFT JOIN kategori ON produk.id_kategori = kategori.id_kategori 
 WHERE id_produk = '$id_produk'");
$detailproduk = $ambil->fetch_assoc();

$fotoproduk = array();

$ambilphoto = $koneksi->query("SELECT * FROM produk_photo WHERE id_produk = '$id_produk'");
while($pecahphoto = $ambilphoto->fetch_assoc()){
    $fotoproduk[] = $pecahphoto;
}



echo "<pre>";
// print_r($detailproduk);
print_r($fotoproduk);
echo "</pre>";

?>

<table class="table">
    <tr>
        <th>Kategori</th>
        <td><?php echo $detailproduk["nama_kategori"]?></td>
    </tr>
    <tr>
        <th>Produk</th>
        <td><?php echo $detailproduk["nama_produk"]?></td>
    </tr>
    <tr>
        <th>Harga</th>
        <td>Rp. <?php echo number_format($detailproduk["harga_produk"])?></td>
    </tr>
    <tr>
        <th>Kualitas</th>
        <td><?php echo $detailproduk["berat_produk"]?></td>
    </tr>
    <tr>
        <th>Deskripsi</th>
        <td><?php echo $detailproduk["deskripsi_produk"]?></td>
    </tr>
    <tr>
        <th>Stok</th>
        <td><?php echo $detailproduk["stok_produk"]?></td>
    </tr>
</table>

<div class="row">
    <?php foreach ($fotoproduk as $key => $value) : ?>
    <div class="col-md-3 text-center">
        <img src='../foto_produk/<?php echo $value["nama_produk_photo"] ?>' class="img-responsive"><br>
        <a href="index.php?halaman=hapusphotoproduk&idphoto=<?php echo $value['id_produk_photo'] ?>&idproduk=<?php echo $id_produk ?>" class="btn btn-danger btn-sm ">Hapus</a>
    </div>
    <?php endforeach; ?>
</div><br><hr>

<form method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label >Tambah Photo</label>
        <input type="file" name="fotobaru">
    </div>
    <button class="btn btn-primary" name="tambah" value="tambah">Tambah</button>
</form>

<?php 

if(isset($_POST['tambah']))
{

    $lokasiphoto = $_FILES["fotobaru"]["tmp_name"]; // lokasi photo sebelum di upload
    $namaphoto = $_FILES["fotobaru"]["name"]; // nama foto di form

    $namaphoto = $namaphoto.date("ymdhs"); // nama photo digabung date

    // upload photo / pindah file photo
    move_uploaded_file($lokasiphoto, "../foto_produk/".$namaphoto); // memindahkan photo

    // Memasukan data photo ke database
    $koneksi->query("INSERT INTO produk_photo (id_produk, nama_produk_photo) VALUES ('$id_produk','$namaphoto')");

    echo "<script>alert('Photo berhasil di tambahkan');</script>";
    echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";


}


?>