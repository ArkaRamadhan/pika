<?php

    include 'koneksi.php';


	$username = $_POST["username"];
	$password = $_POST["password"];

// mengaktifkan session php
session_start();

$login = mysqli_query($koneksi, "select * from admin where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if ($cek > 0) {

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if ($data['username'] == "$username" && $data['password'] == "$password") {
		// buat session login dan username
		$_SESSION['username'] = $username;
		// alihkan ke halaman dashboard pengurus
		header("location:admin_page/admin/index.php");

	} else {
		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}
} else {
	header("location:index.php?pesan=gagal");
}

$admin = mysqli_query($koneksi, "select * from user where username='$username' and password='$password'");
$data_op = mysqli_fetch_assoc($admin);
if ($data_op['username'] == "$username" && $data_op['password'] == "$password") {

	$_SESSION['username'] = $username;
	$_SESSION['status'] = "login";

	header("location:index.html");
}
?>