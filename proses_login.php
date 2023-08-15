<?php
session_start();
include 'koneksi.php'; // Sertakan file koneksi.php atau sesuaikan dengan cara Anda

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Contoh query untuk memeriksa username dan password dari basis data
    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        // Jika data cocok, set sesi dan alihkan ke dashboard admin
        $row = $result->fetch_assoc();
        $_SESSION["admin_id"] = $row["id"]; // Simpan ID admin dalam sesi (session)
        header("Location: admin.php"); // Ganti dengan alamat halaman dashboard
    } else {
        // Jika data tidak cocok, kembali ke halaman login dengan pesan error
        header("Location: login.php?error=1"); // Ganti dengan alamat halaman login
    }
} else {
    header("Location: login.php"); // Jika akses langsung ke file, alihkan ke halaman login
}
?>
