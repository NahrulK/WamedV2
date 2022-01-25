<?php
session_start();
//koneksi ke database
include "koneksi.php";


if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
    echo "<script>alert('Silahkan Login Terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

#mendapatkan id pelanggan dan id pembelian

 $id_pem = $_GET['id'];
 $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian = '$id_pem'");
 $detpem = $ambil->fetch_assoc();

 $id_pelanggan_login = $_SESSION['pelanggan']['id_pelanggan'];
 $pelanggan_yang_beli = $detpem['id_pelanggan'];

 if($id_pelanggan_login != $pelanggan_yang_beli) {
    echo "<script>alert('Jangan Nakal ya');</script>";
    echo "<script>location='riwayat.php';</script>";
    exit();
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Produk</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

    <?php include('menu.php'); ?>

  <!-- <pre><?php //print_r($_SESSION) ; ?> <?php //print_r($detpem); ?></pre> -->
    <section class="konten">
        <div class="container">

        <h2>Bukti Pembayaran</h2>
        <p>Kirim bukti pembayaran anda disini</p>
        <div class="alert alert-info">Total tagihan yang harus dibayar adalah Rp. <?php echo number_format($detpem['total_pembelian']); ?></div>

        <form enctype="multipart/form-data" method="post">
            <div class="form-group">
                <label >Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $_SESSION['pelanggan']['nama_pelanggan'] ?>"  required>
            </div>
            <div class="form-group">
                <label >Bank</label>
                <input type="text" name="bank" class="form-control" required>
            </div>
            <div class="form-group">
                <label >Jumlah</label>
                <input type="number" name="jumlah" class="form-control" value="<?php echo $detpem['total_pembelian'];?>"  required> 
            </div>
            <div class="form-group">
                <label >Poto bukti</label>
                <input type="file" name="bukti" class="form-control"  required>
                <p class="text-danger">Foto bukti harus JPG maksimal 2MB</p>
            </div>
            <button class="btn btn-primary" name="kirim">Kirim</button>            
        </form>

        <?php
        
        if(isset($_POST['kirim'])){

            // mengambil gambar yang di upload
            $namaBukti = $_FILES['bukti']['name']; // namanya di ambil dari input dengan name bukti
            $lokasiBukti = $_FILES['bukti']['tmp_name']; // mengambil sesuai lokasi gambar berada
            $namafiks = $namaBukti.date('YMDs'); // nama bukti digabung dengan tanggal di upload supaya tidak sama namanya
            $nama = $_POST['nama']; // nama pembayar yg di inputkan
            $bank =$_POST['bank'];
            $jumlah = $_POST['jumlah'];
            $tanggal = date('Y-m-d');
            move_uploaded_file($lokasiBukti, "bukti_pembayaran/$namafiks"); 

            //mengirim data dari post ke table pembayaran
            $koneksi->query("INSERT INTO pembayaran(id_pembelian,nama,bank,jumlah,tanggal,bukti) VALUES ('$id_pem','$nama','$bank','$jumlah','$tanggal','$namafiks')");

            //Update status dengan mengganti table
            $koneksi->query("UPDATE pembelian SET status_pembelian='Pembayaran Terkirim' WHERE id_pembelian='$id_pem'");

            echo "<script>alert('Terima kasih sudah melakukan pembayaran');</script>";
            echo "<script>location='riwayat.php';</script>";
            exit();

        }
        
        
        ?>

        </div>
    </section>    


</body>
</html>