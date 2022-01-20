<?php
session_start();
// mengambil ID produk
$id_produk = $_GET['id'];

// jika produk sudah ada di dalam keranjang maka tambahkan 1
if (isset($_SESSION['keranjang'][$id_produk])) {
    $_SESSION['keranjang'][$id_produk] += 1;
} else {
    // jika produk belum ada di dalam keranjang maka keranjang sama dengan 1
    $_SESSION['keranjang'][$id_produk] = 1;
}

// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";

echo "<script>alert('Produk berhasil dimasukkan kedalam keranjang')</script>";
echo "<script>location='keranjang.php';</script>";


?>