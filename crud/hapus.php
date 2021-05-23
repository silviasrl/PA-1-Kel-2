<?php
session_start();

// mengecek apakah user berhasil login atau belum
if( !isset($_SESSION["login"]) ){
  header("Location: ../login.php");
}

// menghubungkan halaman function
require '../function.php';

// ambil data di URL
$id = $_GET["id"];

if (hapus($id) > 0) {
    echo "
                <script>
                    alert('Data Berhasil Dihapus!');
                    document.location.href = '../culinary.php';
                </script>
            ";
} else {
    echo "
                <script>
                    alert('Data Gagal Dihapus!');
                    document.location.href = '../culinary.php';
                </script>
            ";
}
