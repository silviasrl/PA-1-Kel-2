<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "project");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah()
{
    global $conn;
    // upload gambar dulu
    $gambar = upload();
    if (!$gambar) {
        return false;
    }

    // query insert data
    $query = "INSERT INTO kuliner
                    VALUES
                    ('', '$gambar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang di upload
    if ($error == 4) {
        echo "<script>
                alert('Pilih Gambar Terlebih Dahulu');
              </script>";

        return false;
    }

    // cek apakah yang di upload gambar atau bukan
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    // explode : fungsi unutuk memecah sebuah string menjadi array
    // memecahnya menggunakan : delimiter
    $ekstensiGambar = explode('.', $namaFile);
    // strtolower : berguna untuk memaksa seluruh huruf menjadi kecil
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    // in_array : mengecek apakah ada sebuah string didalam array
    if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
        echo "<script>
                alert('Upload Gambar!');
              </script>";

        return false;
    }

    // cek jika ukurannya terlalu besar
    if ($ukuranFile > 3000000) {
        echo "<script>
                alert('Ukuran Gambar Terlalu Besar');
              </script>";

        return false;
    }

    // lolos pengecekan, gambar siap diupload
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;


    move_uploaded_file($tmpName, '../gambar-culinary/' . $namaFileBaru);

    return $namaFileBaru;
}

function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM kuliner WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data)
{
    global $conn;

    // htmlspecialchars : menampilkan dalam bentuk halaman html
    // agar tidak mudah di isengin orang ataupun bahkan user
    $id = $data["id"];
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }

    // query insert data
    $query = "UPDATE kuliner
                    SET
                gambar = '$gambar'
              WHERE id = $id
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// LIKE menambahkan while chard
function cari($keyword)
{
    $query = "SELECT * FROM mahasiswa
        WHERE
        nama LIKE '%$keyword%' OR
        nrp LIKE '%$keyword%' OR
        email LIKE '%$keyword%' OR
        jurusan LIKE '%$keyword%'
        ";
    return query($query);
}

function registrasi($data)
{
    global $conn;

    // strtolower: memaksa seluruh huruf menjadi kecil
    // stripslashes: melarang beberapa karakter agar tidak dapat di masukkan
    $username = strtolower(stripslashes($data["username"]));
    // mysqli_real_escape_string(): memungkinkan user memasukkan password ada tanda kutipnya
    // dan tanda kutipnya akan dimasukkan kedalam database secara aman
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $email = strtolower($data["email"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user 
            WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)) {
        echo "<script>
                alert('Username yang diinput sudah ada');
              </script>";

        return false;
    }


    // cek konfirmasi password
    if ($password !== $password2) {
        echo "<script>
                alert('Password yang anda masukkan tidak sama');
              </script>";

        return false;
    }

    // enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan data baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username',
            '$password', '$email')");

    return mysqli_affected_rows($conn);
}

function komen($data)
{
    global $conn;

    // htmlspecialchars : menampilkan dalam bentuk halaman html
    // agar tidak mudah di isengin orang
    $nama = htmlspecialchars($data["nama"]);
    $komentar = htmlspecialchars($data["komentar"]);

    // query insert data
    $query = "INSERT INTO komentar
                    VALUES
                    ('', '$nama', '$komentar')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
