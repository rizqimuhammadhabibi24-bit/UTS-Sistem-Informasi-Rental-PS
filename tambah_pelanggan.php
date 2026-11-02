<?php 
session_start();
if(!isset($_SESSION['session_login'])){ header("Location: login.php"); exit; }
require 'function.php';

if(isset($_POST['submit'])){
    if(tambah_pelanggan($_POST) > 0){
        echo "<script>
            alert('Pelanggan berhasil ditambahkan!');
            document.location.href = 'pelanggan.php';
            </script>";
    } else {
        echo "<script>alert('Pelanggan gagal ditambahkan!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-form">
<div class="container">
    <div class="form-card">
        <h3>Tambah Data Pelanggan</h3>
        <form action="" method="post">
            <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" placeholder="Masukkan NIK" required>
          </div>
         <div class="form-group">
                <label>Nama Pelanggan</label>
             <input type="text" name="nama" placeholder="Masukkan Nama Lengkap" required>
         </div>
         <div class="form-group">
             <label>No. HP</label>
             <input type="text" name="no_hp" placeholder="Contoh: 08123456789" required>
         </div>
        <div class="form-group">
          <label>Alamat</label>
             <textarea name="alamat" style="width: 100%; padding: 8px;" required></textarea>
        </div>
        <div class="button-group">
             <button type="submit" name="submit" class="btn btn-tambah">Tambah Pelanggan</button>
             <a href="pelanggan.php" class="btn btn-kembali">Kembali</a>
         </div>
      </form>
    </div>
</div>
</body>
</html>