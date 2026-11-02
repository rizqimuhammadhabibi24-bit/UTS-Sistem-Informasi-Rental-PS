<?php 
session_start();
if(!isset($_SESSION['session_login'])){ header("Location: login.php"); exit; }
require 'function.php';

$pelanggan = query_db("SELECT * FROM pelanggan");

if (isset($_POST["cari"])) {
    $keyword = $_POST["keyword"];
    $pelanggan = cari_pelanggan($keyword);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rental PS - Data Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-index">
    <div class="container">
        <div style="float: right;">
            <a href="logout.php" class="btn btn-hapus" onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </div>
        <h3 style="text-align: center">Sistem Informasi Rental PS</h3>
        
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="index.php" class="btn btn-edit">Menu 1: Data Konsol PS</a> | 
            <a href="pelanggan.php" class="btn btn-tambah">Menu 2: Data Pelanggan</a>
        </div>

        <div class="top-bar">
            <form action="" method="post" class="search-box">
                <input type="text" name="keyword" placeholder="Cari nama/NIK/No HP...">
                <button type="submit" name="cari" class="btn btn-cari">Cari</button>
            </form>
            <a href="tambah_pelanggan.php" class="btn btn-tambah">+ Tambah Pelanggan</a>
        </div>

 <table>
      <thead>
       <tr>
        <th>No.</th>
           <th>NIK</th>
           <th>Nama</th>
            <th>No. HP</th>
            <th>Alamat</th>
            <th>Aksi</th>
         </tr>
 </thead>
     <tbody>
        <?php $nomor = 1; ?>
        <?php foreach($pelanggan as $data): ?>
      <tr>
         <td><?php echo $nomor; ?></td>
         <td><?php echo $data["nik"]; ?></td>
        <td><?php echo $data["nama"]; ?></td>
         <td><?php echo $data["no_hp"]; ?></td>
         <td><?php echo $data["alamat"]; ?></td>
      <td>
            <a href="edit_pelanggan.php?id=<?php echo $data["id"]?>" class="btn btn-edit">Edit</a>
             <a href="hapus_pelanggan.php?id=<?php echo $data["id"] ?>" class="btn btn-hapus" onclick="return confirm('Hapus pelanggan?')">Hapus</a>
         </td>
            </tr>
            <?php $nomor++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</body>
</html>