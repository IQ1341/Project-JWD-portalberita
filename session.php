<?php
session_start();

// Pemeriksaan sesi admin
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit();
}

// Fungsi Logout
if (isset($_GET["logout"])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

include 'koneksi.php'; // 

// Ambil informasi nama admin dari basis data berdasarkan ID admin dalam sesi
$adminId = $_SESSION["admin_id"];
$queryAdmin = "SELECT username FROM admin WHERE id = $adminId";
$resultAdmin = $conn->query($queryAdmin);
$adminName = "";

if ($resultAdmin->num_rows > 0) {
    $adminData = $resultAdmin->fetch_assoc();
    $adminName = $adminData["username"];
}
?>