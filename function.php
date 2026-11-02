<?php   
// Koneksi ke Database
$conn = mysqli_connect("localhost", "root", "", "rental_ps");   

function query_db($query) {   
    global $conn;   
    $result = mysqli_query($conn, $query);   
    $rows = [];   
    while( $row = mysqli_fetch_assoc($result) ) {   
        $rows[] = $row;   
    }   
    return $rows;   
}   

// --- FUNGSI MENU 1: KONSOL PS ---
function tambah_konsol($data){   
    global $conn;   

    $nama_konsol = htmlspecialchars($data['nama_konsol']);   
    $tipe        = htmlspecialchars($data['tipe']);   
    $harga_sewa  = htmlspecialchars($data['harga_sewa']);   
    $status      = htmlspecialchars($data['status']);   

    // Proses upload gambar menggunakan fungsi upload_gambar
    $gambar = upload_gambar($tipe, $nama_konsol);   
    if( !$gambar ){   
        return false;   
    }   

    $query = "INSERT INTO konsol (nama_konsol, tipe, harga_sewa, status, gambar)   
               VALUES ('$nama_konsol', '$tipe', '$harga_sewa', '$status', '$gambar')";   

    mysqli_query($conn, $query);   
    return mysqli_affected_rows($conn);   
}   

function hapus_konsol($id){   
    global $conn;   
    $query = "DELETE FROM konsol WHERE id = $id";   
    mysqli_query($conn, $query);   
    return mysqli_affected_rows($conn);   
}   

function edit_konsol($data){   
    global $conn;   

    $id          = $data["id"];   
    $nama_konsol = htmlspecialchars($data['nama_konsol']);   
    $tipe        = htmlspecialchars($data['tipe']);   
    $harga_sewa  = htmlspecialchars($data['harga_sewa']);   
    $status      = htmlspecialchars($data['status']);   
    $gambarLama  = htmlspecialchars($data['gambarLama']);   

    // Cek apakah user memilih gambar baru atau menggunakan gambar lama
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload_gambar($tipe, $nama_konsol);   
        if( !$gambar ){   
            return false;   
        }   
    }

    $query = "UPDATE konsol SET   
                nama_konsol = '$nama_konsol',   
                tipe        = '$tipe',   
                harga_sewa  = '$harga_sewa',   
                status      = '$status',   
                gambar      = '$gambar'   
              WHERE id = $id";   

    mysqli_query($conn, $query);   
    return mysqli_affected_rows($conn);   
}   

function cari_konsol($keyword) {   
    global $conn;   
    $keyword = mysqli_real_escape_string($conn, $keyword);   

    $query = "SELECT * FROM konsol   
              WHERE   
              nama_konsol LIKE '%$keyword%' OR   
              tipe LIKE '%$keyword%' OR   
              status LIKE '%$keyword%'";   

    return query_db($query);   
}   

// --- FUNGSI MENU 2: PELANGGAN ---
function tambah_pelanggan($data) {
    global $conn;
    $nik    = htmlspecialchars($data["nik"]);
    $nama   = htmlspecialchars($data["nama"]);
    $no_hp  = htmlspecialchars($data["no_hp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "INSERT INTO pelanggan (nik, nama, no_hp, alamat)
              VALUES ('$nik', '$nama', '$no_hp', '$alamat')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function hapus_pelanggan($id) {
    global $conn;
    $query = "DELETE FROM pelanggan WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function edit_pelanggan($data) {
    global $conn;
    $id     = $data["id"];
    $nik    = htmlspecialchars($data["nik"]);
    $nama   = htmlspecialchars($data["nama"]);
    $no_hp  = htmlspecialchars($data["no_hp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "UPDATE pelanggan SET
                nik    = '$nik',
                nama   = '$nama',
                no_hp  = '$no_hp',
                alamat = '$alamat'
              WHERE id = $id";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);
}

function cari_pelanggan($keyword) {
    global $conn;
    $keyword = mysqli_real_escape_string($conn, $keyword);
    $query = "SELECT * FROM pelanggan
              WHERE
              nik LIKE '%$keyword%' OR
              nama LIKE '%$keyword%' OR
              no_hp LIKE '%$keyword%'";
    return query_db($query);
}

// --- FUNGSI UPLOAD GAMBAR (SESUAI MATERI KULIAH) ---
function upload_gambar($tipe, $nama){   
    $namaFile   = $_FILES['gambar']['name'];   
    $ukuranFile = $_FILES['gambar']['size'];   
    $error      = $_FILES['gambar']['error'];   
    $tmpName    = $_FILES['gambar']['tmp_name'];   

    if( $error === 4 ){   
        echo "<script>   
            alert('Kamu belum upload file, silakan upload file terlebih dahulu!');   
            </script>";   
        return false;   
    }   

    // ekstensi file gamabar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png', 'jfif'];   
    $ekstensiGambar      = explode('.', $namaFile);   
    $ekstensiGambar      = strtolower(end($ekstensiGambar));   
    
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ){   
        echo "<script>   
            alert('File yang kamu upload bukan format JPG/JPEG/PNG/JFIF!');   
            </script>";   
        return false;   
    }   

    if( $ukuranFile > 5000000 ){   
        echo "<script>   
            alert('File yang kamu upload terlalu besar ukurannya!');   
            </script>";   
        return false;   
    }   

    $namaFileBaru  = $tipe . "_" . $nama;   
    $namaFileBaru .= '.';   
    $namaFileBaru .= $ekstensiGambar;   

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);   

    return $namaFileBaru;   
}   

//  FUNGSI REGISTRASI USER
function registrasi($data){   
    global $conn;   

    $username            = strtolower(stripslashes($data["username"]));   
    $password            = mysqli_real_escape_string($conn, $data["password"]);   
    $konfirmasi_password = mysqli_real_escape_string($conn, $data["konfirmasi_password"]);   

    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");   

    if(mysqli_fetch_assoc($result)){   
        echo "<script>   
            alert('Username sudah terdaftar! Gunakan username lainnya!');   
            </script>";   
        return false;   
    }   

    if($password !== $konfirmasi_password ){   
        echo "<script>   
            alert('Konfirmasi password tidak sesuai!');   
            </script>";   
        return false;   
    }   

    $password = password_hash($password, PASSWORD_DEFAULT);   

    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");   
    return mysqli_affected_rows($conn);   
}   
?>