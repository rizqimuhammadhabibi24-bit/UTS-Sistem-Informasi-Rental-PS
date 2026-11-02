<?php 
session_start();
if(!isset($_SESSION['session_login'])){ header("Location: login.php"); exit; }
require 'function.php';

$id = $_GET["id"];
$pelanggan = query_db("SELECT * FROM pelanggan WHERE id = $id")[0];

if (isset($_POST["submit"])) {
    if (edit_pelanggan($_POST) > 0) {
        echo "<script>
                alert('Data pelanggan berhasil diubah!');
                document.location.href = 'pelanggan.php';
            </script>";
    } else {
        echo "<script>
                alert('Data pelanggan gagal diubah!');
                document.location.href = 'pelanggan.php';
            </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Pelanggan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="page-form">
<div class="container">
    <div class="form-card">
        <h3>Edit Data Pelanggan</h3>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?php echo $pelanggan["id"]; ?>">

          <div class="form-group">
         <label>NIK</label>
            <input type="text" name="nik" value="<?php echo $pelanggan["nik"]; ?>" required>
        </div>
        <div class="form-group">
           <label>Nama Pelanggan</label>
             <input type="text" name="nama" value="<?php echo $pelanggan["nama"]; ?>" required>
         </div>
            <div class="form-group">
            <label>No. HP</label>
                <input type="text" name="no_hp" value="<?php echo $pelanggan["no_hp"]; ?>" required>
            </div>
            <div class="form-group">
            <label>Alamat</label>
                <textarea name="alamat" style="width: 100%; padding: 8px;" required><?php echo $pelanggan["alamat"]; ?></textarea>
            </div>
            <div class="button-group">
             <button type="submit" name="submit" class="btn btn-edit">Simpan Perubahan</button>
                <a href="pelanggan.php" class="btn btn-kembali">Kembali</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>