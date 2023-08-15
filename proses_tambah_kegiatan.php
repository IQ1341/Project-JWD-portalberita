<?php
include 'koneksi.php';

$targetDir = "img/";
$targetFile = $targetDir . basename($_FILES["gambar"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Cek apakah file gambar yang diunggah adalah gambar valid
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["gambar"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File bukan gambar.";
        $uploadOk = 0;
    }
}

// Upload gambar jika memenuhi syarat
if ($uploadOk == 1) {
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
        $judul = $_POST["judul"];
        $ringkasan = $_POST["ringkasan"];
        $pathGambar = $targetFile;

        // Masukkan data ke dalam tabel berita
        $query = "INSERT INTO berita (judul, ringkasan, path_gambar) VALUES ('$judul', '$ringkasan', '$pathGambar')";
        if ($conn->query($query) === TRUE) {
            echo "Berita berhasil diunggah.";
        } else {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    } else {
        echo "Terjadi kesalahan saat mengunggah gambar.";
    }
    header("Location: admin.php");
}
?>
