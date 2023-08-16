<?php
$servername = "localhost"; //  alamat server database 
$username = "root"; //  username database Anda
$password = ""; //  password database Anda
$dbname = "115_muhammad_iqbal"; // nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
