<?php
$datakategori = array();

$ambil = $koneksi->query("SELECT * FROM kategori");
while($pecah = $ambil->fetch_assoc()){
    $datakategori[] = $pecah;
}
?>

<!-- <pre>
    <?php //print_r($datakategori); ?>
</pre> -->


<h2>Tambah Produk</h2>

<form  method="post"  enctype="multipart/form-data">
    <div class="form-group">
        <label for="">Nama</label>
        <input type="text" class="form-control" name="nama">
    </div>
    <div class="form-group">
        <label for="">Kategori</label>
        <select name="id_kategori" class="form-control">
            <option value="Pilih Kategori">Pilih Kategori</option>
            <?php foreach ($datakategori as $key => $value) : ?>
            <option value="<?php echo $value['id_kategori'] ?>"><?php echo $value['nama_kategori']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="">Harga (Rp)</label>
        <input type="number" class="form-control" name="harga">
    </div>
    <div class="form-group">
        <label for="">Kualitas</label>
        <input type="number" class="form-control" name="berat">
    </div>
    <div class="form-group">
        <label for="">Stok</label>
        <input type="number" class="form-control" name="stok">
    </div>
    <div class="form-group">
        <label for="">Deskripsi</label>
        <textarea class="form-control" name="deskripsi" rows="10"></textarea>
    </div>
    <div class="form-group">
        <label for="">foto</label>
        <div class="letak-input" style="margin-bottom: 10px;">
        <input type="file" class="form-control" name="foto[]">
        </div>
        <span class="btn btn-primary btn-tambah">
            <i class="fa fa-plus"></i>
        </span>
    </div>
    <button class="btn btn-primary" name="save">Simpan</button>
</form>
<?php

if(isset($_POST['save'])) 
 {
    $namanamafoto = $_FILES['foto']['name'];
    $lokasilokasifoto = $_FILES['foto']['tmp_name'];
    move_uploaded_file($lokasilokasifoto[0], "../foto_produk/".$namanamafoto[0]);
    $koneksi->query("INSERT INTO produk
    (nama_produk,harga_produk,berat_produk,foto_produk,deskripsi_produk, id_kategori,stok_produk) 
    VALUES('$_POST[nama]', '$_POST[harga]', '$_POST[berat]', '$namanamafoto[0]', '$_POST[deskripsi]','$_POST[id_kategori]','$_POST[stok]')");

    $id_produk_barusan = $koneksi->insert_id;

    foreach ($namanamafoto as $key => $tiap_nama) 
    {
        $tiap_lokasi = $lokasilokasifoto[$key];

        move_uploaded_file($tiap_lokasi, "../foto_produk/".$tiap_nama);

        // simpan ke mysql
        $koneksi->query("INSERT INTO produk_photo (id_produk, nama_produk_photo) VALUES ('$id_produk_barusan','$tiap_nama')");
    }

    echo "<div class='alert alert-info'>Data Tersimpan</div>";
    echo "<div><meta http-equiv='refresh' content='1;url=index.php?halaman=produk'></div>";

    // echo "<pre>";
    // print_r($_FILES['foto']);
    // echo "</pre>";
}

?>

<script>
    $(document).ready(function(){
        $(".btn-tambah").on("click", function(){
            $(".letak-input").append("<input type='file' class='form-control' name='foto[]'>");
        })
    })
</script>
