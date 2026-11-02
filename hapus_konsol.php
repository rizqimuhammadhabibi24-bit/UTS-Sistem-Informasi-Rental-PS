<?php 
session_start();
if(!isset($_SESSION['session_login'])){ header("Location: login.php"); exit; }
require 'function.php';

$id = $_GET["id"];

if(hapus_konsol($id) > 0){
    echo "<script>
        alert('Konsol berhasil dihapus!');
        document.location.href = 'index.php';
        </script>";
} else {
    echo "<script>
        alert('Konsol gagal dihapus');
        document.location.href = 'index.php';
        </script>";
}
?>