<?php 
session_start();
if(!isset($_SESSION['session_login'])){ header("Location: login.php"); exit; }
require 'function.php';

$id = $_GET["id"];
$data_konsol = query_db("SELECT * FROM konsol WHERE id = $id");

if (empty($data_konsol)) {
    echo "<script>
         alert('Data tidak ditemukan!');
         document.location.href = 'index.php';
          </script>";
    exit;
}

$konsol = $data_konsol[0];

if (isset($_POST["submit"])) {
    if (edit_konsol($_POST) > 0) {
        echo "<script>
            alert('Data konsol berhasil diubah!');
             document.location.href = 'index.php';
       </script>";
    } else {
        echo "<script>
            alert('Data gagal diubah!');
             document.location.href = 'index.php';
         </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Konsol PS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-form">
<div class="container">
    <div class="form-card">
      <h3>Edit Data Konsol</h3>
     <form action="" method="post" enctype="multipart/form-data">
     <input type="hidden" name="id" value="<?php echo $konsol["id"]; ?>">

     <div class="form-group">
      <label>Nama Konsol</label>
       <input type="text" name="nama_konsol" value="<?php echo $konsol["nama_konsol"]; ?>" required>
       </div>
          <div class="form-group">
             <label>Tipe Konsol</label>
           <input type="text" name="tipe" value="<?php echo $konsol["tipe"]; ?>" required>
       </div>
            <div class="form-group">
           <label>Harga Sewa / Jam</label>
                <input type="number" name="harga_sewa" value="<?php echo $konsol["harga_sewa"]; ?>" required>
       </div>
         <div class="form-group">
          <label>Status</label>
            <input type="text" name="status" value="<?php echo $konsol["status"]; ?>" required>
      </div>
         <div class="form-group">
           <label>Upload Gambar Baru</label><br>
             <img src="img/<?php echo $konsol["gambar"]; ?>" width="80"><br><br>
              <input type="file" name="gambar" required>
     </div>
         <div class="button-group">
            <button type="submit" name="submit" class="btn btn-edit">Simpan Perubahan</button>
             <a href="index.php" class="btn btn-kembali">Kembali</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>