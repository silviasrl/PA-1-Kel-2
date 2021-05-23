<?php
session_start();
// mengecek apakah user berhasil login atau belum
if( isset($_SESSION["login"]) ){
	header("Location: home.php");
}

require 'function.php';

// cek apakah tombol login sudah ditekan atau belum
if (isset($_POST["login"])) {

	// cek username & password
	$username = $_POST["username"];
	$password = $_POST["password"];

	// mengecek username tertentu apakah ada di dalam tabel user pada database project
	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	// cek username
	// mysqli_num_rows(): menghitung berapa baris yang dikembalikan dari fungsi didalam variable $result
	if (mysqli_num_rows($result) === 1) {

		// cek password
		$row = mysqli_fetch_assoc($result);
		// password_verify(): mengecek apakah string dari password yang di masukkan user sama dengan password yang telah di acak/hash
		if (password_verify($password, $row["password"])) {

			// set session
			$_SESSION["login"] = true;

			header("Location: home.php");
			exit;
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" href="my_css/style-css.css">
</head>

<body>
	<?php if (isset($error)) : ?>
		<script>
			alert("Username atau Password Salah!")
		</script>
	<?php endif ?>

	<form class="box" action="" method="post">
		<h1>LOGIN HERE</h1>
		<input type="text" name="username" placeholder="Username">
		<input type="password" name="password" placeholder="Password">
		<input type="submit" name="login" value="Login">
		<a href="registrasi.php">
			<p>Belum Punya Akun? Register</p>
		</a>
	</form>
</body>

</html>