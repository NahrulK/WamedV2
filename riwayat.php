<?php
session_start();
//koneksi ke database
include "koneksi.php";


if(!isset($_SESSION['pelanggan']) OR empty($_SESSION['pelanggan'])){
    echo "<script>alert('Silahkan Login Terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pelanggan</title>
    <link rel="stylesheet" href="admin/assets/css/bootstrap.css">
</head>
<body>

    <?php include('menu.php'); ?>

<section class="riwayat">
    <div class="container">
        <h3>Riwayat Belanja <strong> <?php echo $_SESSION["pelanggan"]["nama_pelanggan"]; ?></strong></h3>

        <table class=" table table-bordered ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                 $id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
                 $ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pelanggan='$id_pelanggan'");                 
                ?>
                <?php $number = 1;?>
                <?php while($pecah = $ambil->fetch_assoc()) { ?>

                <tr>
                    <td><?php echo $number ?></td>
                    <td><?php echo $pecah['tanggal_pembelian']; ?></td>
                    <td><?php echo $pecah['status_pembelian']; ?>
                    <br>
                    <?php if(!empty($pecah['resi_pengiriman'])) : ?>
                       Resi Pengiriman : <?php echo $pecah['resi_pengiriman'] ;?>
                    <?php endif ?>
                    </td>
                    <td>Rp. <?php echo number_format($pecah['total_pembelian']); ?></td>
                    <td>
                        <a href="nota.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-info">Nota</a>
                            <?php if($pecah['status_pembelian'] == 'pending') : ?>
                            <a href="pembayaran.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-primary">input Pembayaran</a>
                        <?php else : ?>
                            <a href="lihat_pembayaran.php?id=<?php echo $pecah['id_pembelian'] ?>" class="btn btn-warning">Lihat Pembayaran</a>
                        <?php endif;?>
                    </td>
                </tr>
                <?php $number++; ?>
                <?php }?>
            </tbody>
        </table>

    </div>
</section>