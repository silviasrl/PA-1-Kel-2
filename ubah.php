<?php
session_start();

// mengecek apakah user berhasil login atau belum
if( !isset($_SESSION["login"]) ){
  header("Location: login.php");
}

// require / include (untuk menghubungkan ke halaman function)
require 'function.php';
$kuliner = query("SELECT * FROM kuliner");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Ubah Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="my_css/style-kuliner.css">
    <link href="style.css" rel="stylesheet">
</head>

<body>
    <h1>Daftar Makanan / Minuman</h1>

    <table class="table">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($kuliner as $row) : ?>
            <div class="container">
                <div class="row">
                    <tr>
                        <div class="col-sm-2">
                            <td class="succes">
                                <?= $i; ?>
                            </td>
                        </div>
                        <div class="col-sm-2">
                            <td>
                                <a href="crud/ubah.php?id=<?= $row["id"]; ?>" class="btn btn-success">Ubah</a>
                            </td>
                        </div>
                        <div class="col-sm-5">
                            <td class="active">
                                <a href="#" class="thumbnail"><img src="gambar-culinary/<?= $row["gambar"]; ?>"></a>
                            </td>
                        </div>
                    </tr>
                </div>
            </div>
            <?php $i++; ?>
        <?php endforeach ?>
    </table>
</body>

</html>