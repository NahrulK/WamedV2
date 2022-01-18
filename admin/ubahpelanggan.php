<h2>Ubah pelanggan</h2>

<?php

$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan = '$_GET[id]'");

$pecah = $ambil->fetch_assoc();

?>

<form  method="post"  enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Nama</label>
        <input type="text" class="form-control" name="nama" value="<?php echo $pecah['nama_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo $pecah['email_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label for="">Password</label>
        <input type="password" class="form-control" name="password" value="<?php echo $pecah['password_pelanggan']; ?>">
    </div>
    <div class="form-group">
        <label for="">Telepon</label>
        <input type="number" class="form-control" name="telepon" value="<?php echo $pecah['telepon_pelanggan']; ?>">
    </div>
    
     <button class="btn btn-primary" name="ubah">Ubah</button>
</form>

<?php


if(isset($_POST['ubah'])) {
   
        $koneksi->query("UPDATE pelanggan SET nama_pelanggan='$_POST[nama]',email_pelanggan='$_POST[email]',password_pelanggan='$_POST[password]',telepon_pelanggan='$_POST[telepon]' WHERE id_pelanggan='$_GET[id]'");

    
    echo "<script>alert('Data pelanggan Berhasil Diubah');</script>";
    echo "<script>location='index.php?halaman=pelanggan';</script>";
}


?>



