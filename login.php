<?php   
session_start();  
require 'function.php';  

if(isset($_POST['login'])){  
    $username = $_POST['username'];  
    $password = $_POST['password'];  

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username' ");  

    if(mysqli_num_rows($result) === 1){  
        $row = mysqli_fetch_assoc($result);  
        if(password_verify($password, $row['password'])){  
            $_SESSION['session_login'] = true;  
            $_SESSION['username'] = $username;  
            header('Location: index.php');  
            exit;  
        } else {  
            echo "<script>alert('Password yang kamu masukkan salah!');</script>";   
        }  
    } else {  
        echo "<script>alert('Username yang kamu masukkan salah atau tidak ditemukan!');</script>";  
    }  
}  
?>  

<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <title>Login - Rental PS</title>  
    <link rel="stylesheet" href="style.css">  
</head>  
<body class="page-register">  
    <div class="container">  
        <div class="form-card">  
            <h3 style="text-align: center;">Login Admin Rental PS</h3>  
            <form action="" method="post">  
                <div class="form-group">  
                    <label for="username">Username</label>  
                    <input type="text" name="username" placeholder="Masukkan username" required>  
                </div>  
                <div class="form-group">  
                <label for="password">Password</label>  
                <input type="password" name="password" placeholder="Masukkan password" required>  
                </div>  
                <div class="button-group">  
                    <button type="submit" name="login" class="btn btn-edit">Login</button>  
                    <a href="registrasi.php" class="btn btn-kembali">Registrasi</a>  
            </div>  
        </form>  
     </div>  
    </div>  
</body>  
</html>