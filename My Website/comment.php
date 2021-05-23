<?php
// require / include (untuk menghubungkan ke halaman function)
require 'function.php';
$komentar = query("SELECT * FROM komentar");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Daftar Komentar</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" />
</head>

<body>
    <h1>Daftar Komentar</h1>

    <table border="1" cellpadding="10" cellspacing="0" class="table">
        <tr>
            <th></th>

            <th class="active">No.</th>
            <th class="succes">Nama</th>
            <th class="warning">Komentar</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($komentar as $row) : ?>
            <tr>
                <td></td>

                <td><?= $i; ?></td>
                <td class="danger"><?= $row["nama"]; ?></td>
                <td class="info"><?= $row["komentar"]; ?></td>
            </tr>
            <?php $i++; ?>
        <?php endforeach ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>

            <td>
                <a href="contactperson.php" class="btn btn-success" style="float: right; margin-right: 40px;">Kembali</a>
            </td>
        </tr>
    </table>


</body>

</html>