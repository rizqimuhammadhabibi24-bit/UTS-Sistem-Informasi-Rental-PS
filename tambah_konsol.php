<?php 
session_start();
if(!isset($_SESSION['session_login'])){ header("Location: login.php"); exit; }
require 'function.php';

if(isset($_POST['submit'])){
    if(tambah_konsol($_POST) > 0){
        echo "<script>
            alert('Konsol berhasil ditambahkan!');
            document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
            alert('Konsol gagal ditambahkan!');
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Konsol PS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-form">
<div class="container">
    <div class="form-card">
        <h3>Tambah Konsol PS</h3>
        <!-- Wajib menggunakan enctype multipart/form-data -->
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Konsol</label>
                <input type="text" name="nama_konsol" placeholder="Contoh: PlayStation 5 Pro - Room A" required>
            </div>
            <div class="form-group">
                <label>Tipe Konsol</label>
                <input type="text" name="tipe" placeholder="Contoh: PS5 Pro" required>
            </div>
            <div class="form-group">
                <label>Harga Sewa / Jam</label>
                <input type="number" name="harga_sewa" placeholder="Contoh: 40000" required>
            </div>
            <div class="form-group">
                <label>Status</label>
                <input type="text" name="status" placeholder="Tersedia / Disewa" required>
            </div>
            <div class="form-group">
                <label>Upload Gambar Konsol</label>
                <input type="file" name="gambar" required>
            </div>
            <div class="button-group">
                <button type="submit" name="submit" class="btn btn-tambah">Tambah Konsol</button>
                <a href="index.php" class="btn btn-kembali">Kembali</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>