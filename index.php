<?php 
    session_start();
    if(!isset($_SESSION['session_login'])){
        header("Location: login.php");
        exit;
    }

    require 'function.php';
    $konsol = query_db("SELECT * FROM konsol");

    if (isset($_POST["cari"])) {
        $keyword = $_POST["keyword"];
        $konsol = cari_konsol($keyword);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sistem Rental PS - Data Konsol</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-index">
    <div class="container">
        <div style="float: right;">
            <a href="logout.php" class="btn btn-hapus" onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </div>
        <h3 style="text-align: center">Sistem Informasi Rental PS</h3>
        
        <!-- Menu Utama -->
        <div style="text-align: center; margin-bottom: 20px;">
            <a href="index.php" class="btn btn-tambah">Menu 1: Data Konsol PS</a> | 
            <a href="pelanggan.php" class="btn btn-edit">Menu 2: Data Pelanggan</a>
        </div>

        <div class="top-bar">
            <form action="" method="post" class="search-box">
             <input type="text" name="keyword" placeholder="Cari konsol/status...">
            <button type="submit" name="cari" class="btn btn-cari">Cari</button>
            </form>

            <a href="tambah_konsol.php" class="btn btn-tambah">+ Tambah Konsol</a>
        </div>

<table>
    <thead>
         <tr>
           <th>No.</th>
              <th>Nama Konsol</th>
              <th>Tipe</th>
              <th>Harga / Jam</th>
              <th>Status</th>
               <th>Gambar</th>
               <th>Aksi</th>
         </tr>
        </thead>
     <tbody>
         <?php $nomor = 1; ?>
          <?php foreach($konsol as $data): ?>
         <tr>
            <td><?php echo $nomor; ?></td>
             <td><?php echo $data["nama_konsol"]; ?></td>
             <td><?php echo $data["tipe"]; ?></td>
             <td>Rp <?php echo number_format($data["harga_sewa"]); ?></td>
            <td><?php echo $data["status"]; ?></td>
         <td>
                    <img src="img/<?php echo $data['gambar']; ?>" width="60" height="60" style="object-fit: cover; border-radius: 5px;">
             </td>
          <td>
               <a href="edit_konsol.php?id=<?php echo $data["id"]?>" class="btn btn-edit">Edit</a>
               <a href="hapus_konsol.php?id=<?php echo $data["id"] ?>" class="btn btn-hapus" onclick="return confirm('Hapus konsol ini?')">Hapus</a>
                </td>
            </tr>
            <?php $nomor++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</body>
</html>