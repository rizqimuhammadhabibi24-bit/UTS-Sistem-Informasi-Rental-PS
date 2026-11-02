<?php 
session_start();
if(!isset($_SESSION['session_login'])){ header("Location: login.php"); exit; }
require 'function.php';

$id = $_GET["id"];

if(hapus_pelanggan($id) > 0){
    echo "<script>
     alert('Pelanggan berhasil dihapus!');
     document.location.href = 'pelanggan.php';
     </script>";
} else {
    echo "<script>
     alert('Pelanggan gagal dihapus');
     document.location.href = 'pelanggan.php';
     </script>";
}
?>