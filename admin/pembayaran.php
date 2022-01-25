<h2>Data Pembayaran</h2>

<?php
$id_pembelian = $_GET['id_pembelian'];
// $id_pelanggan = $_GET['id_pelanggan'];

$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian = '$id_pembelian'");
$detail = $ambil->fetch_assoc();

?>

<!-- <pre>
     <?php //print_r($detail); ?> 
</pre> -->

<div class="row">
    <div class="col-md-6">
        <table class="table">
            <tr>
                <th>Nama: </th>
                <td><?php echo $detail['nama']; ?></td>
            </tr>
            <tr>
                <th>Bank: </th>
                <td><?php echo $detail['bank']; ?></td>
            </tr>
            <tr>
                <th>Jumlah: </th>
                <td>Rp. <?php echo number_format($detail['jumlah']); ?></td>
            </tr>
            <tr>
                <th>Tanggal: </th>
                <td><?php echo $detail['tanggal']; ?></td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <img src="../bukti_pembayaran/<?php echo $detail['bukti'] ?>" class="img-responsive">
    </div>
</div>

<form method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="resi">
    </div>
    <div class="form-group">
        <label >Status</label>
        <Select class="form-control" name="status">
            <option value="">Pilih Status</option>
            <option value="Barang Dikirim">Barang Dikirim</option>
            <option value="Pembayaran Lunas">Lunas</option>
            <option value="Pesanan Dibatalkan">Batal</option>
        </Select>
    </div>
    <button class="btn btn-primary" name="proses">Proses</button>
</form>

<?php

if(isset($_POST['proses'])) {

    $resi = $_POST['resi'];
    $stautus = $_POST['status'];

    //melakukan update pada resi dan status setelah tombol proses ditekan
    $koneksi->query("UPDATE pembelian SET resi_pengiriman='$resi' , status_pembelian='$stautus' WHERE id_pembelian='$id_pembelian'");

    echo "<script>alert('Data berhasil diupdate');</script>";
    echo "<script>location='index.php?halaman=pembelian';</script>";
    
    exit();

}

?>