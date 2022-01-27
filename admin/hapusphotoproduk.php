<?php
$id_produk = $_GET['idproduk'];
$id_photo = $_GET['idphoto'];

// Ambil data di tabel photo
$ambilphoto = $koneksi->query("SELECT * FROM produk_photo WHERE id_produk_photo = '$id_photo'");
$detailphoto = $ambilphoto->fetch_assoc();

//ambil nama file photo
$namafilephoto = $detailphoto["nama_produk_photo"];
// hapus file photo dari folder
unlink("../foto_produk/".$namafilephoto);

// Hapus data photo daru mysql
$koneksi->query("DELETE FROM produk_photo WHERE id_produk_photo = '$id_photo'");

echo "<script>alert('Photo berhasil di sudah terhapus');</script>";
echo "<script>location='index.php?halaman=detailproduk&id=$id_produk';</script>";


?>