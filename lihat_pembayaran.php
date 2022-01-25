<?php


session_start();
include "koneksi.php";
if(!isset($_SESSION['pelanggan'])) {

    echo "<script>alert('Anda Harus Login');</script>";
    echo "<script>location='login.php';</script>";
    
    exit();
 
}

$id_pem = $_GET['id'];
 $ambil = $koneksi->query("SELECT * FROM pembayaran LEFT JOIN pembelian ON
 pembayaran.id_pembelian = pembelian.id_pembelian WHERE pembelian.id_pembelian = '$id_pem'");

 $detbay = $ambil->fetch_assoc();

// jika belum ada data pembeelian 
 if(empty($detbay)) {

    echo "<script>alert('Belum ada data pembelian');</script>";
    echo "<script>location='riwayat.php';</script>";

 }

//  jika pelanggan berusaha mlihat data pembelian pelanggan lain
if ($_SESSION['pelanggan']['id_pelanggan'] !== $detbay['id_pelanggan']){
    echo "<script>alert('Anda tidak boleh melihat data pembelian orang lain');</script>";
    echo "<script>location='riwayat.php';</script>";
}

?>

<!-- <PRE>
  <?php  //print_r($detbay)?>
</PRE> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>   
<?php include('menu.php'); ?>

<section class="container">
    <div class="row">
        <div class="col-md-6">
            <table class="table">
            <tr>
                <th>Nama</th>
                <td><?php echo $detbay['nama']; ?></td>
            </tr>
            <tr>
                <th>Bank</th>
                <td><?php echo $detbay['bank'];?></td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td><?php echo $detbay['tanggal'];?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td><?php echo $detbay['status_pembelian'];?></td>
            </tr>
            <tr>
                <th>Jumlah</th>
                <td>Rp. <?php echo number_format($detbay['jumlah']);?></td>
            </tr>           
            </table>
        </div>
        <div class="col-md-6">
            <img src="bukti_pembayaran/<?php echo $detbay['bukti']; ?>" class="img-responsive" width="225">
        </div>
    </div>

</section>

</body>
</html>
