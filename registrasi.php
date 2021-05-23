<?php
// hubungkan ke halaman function
require 'function.php';

// jika tombol register sudah ditekan
if (isset($_POST["register"])) {
    if (registrasi($_POST) > 0) {
        echo "<script>
                alert('Registrasi Berhasil!');
              </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Halaman Register</title>
    <link rel="stylesheet" href="my_css/style-register.css">
</head>

<body>
    <div class="container">
        <h1>Register</h1>
        <form action="" method="post">
            <label for="username">Username</label><br>
            <input type="text" name="username" id="username"><br>

            <label for="password">Password</label><br>
            <input type="password" name="password" id="password"><br>

            <label for="password2">Konfirmasi Password</label><br>
            <input type="password" name="password2" id="password2"><br>

            <label for="email">Email</label><br>
            <input type="text" name="email" id="email"><br>

            <button type="submit" name="register">Register</button>
            <p> Sudah punya akun?
                <a href="login.php">Login di sini</a>
            </p>
        </form>
    </div>
</body>

</html>