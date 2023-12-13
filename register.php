<?php
include 'koneksi.php';

    $username = strtolower(stripslashes($_POST['username']));
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];

    // cek username sudah ada atau belum
    include 'koneksi.php';
    $hasil = mysqli_query($koneksi, "select * from user where username='$username'");

    if (mysqli_fetch_assoc($hasil)) {
        echo "<script>
                    alert('Username ini sudah di pakai');
                </script>";
        return false;
    }

    // cek konfirmasi pasword
    if ($password !== $password2) {
        echo "<script>
                    alert('Password tidak sesuai');
                </script>";
        return false;
    }

    include 'koneksi.php';
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    mysqli_query($koneksi, "insert into user values('', '$username', '$password', '$nama','$kelas')");
    echo "<script>
                    alert('Berhasil menambahkan user baru');
                </script>";
    header("location:login.php");
    return mysqli_affected_rows($koneksi);


?>
