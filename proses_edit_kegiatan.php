<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $judul = $_POST["judul"];
    $ringkasan = $_POST["ringkasan"];

    // Proses upload gambar baru jika ada
    $gambarPath = ""; // Menyimpan path gambar yang baru

    if ($_FILES["gambar"]["error"] === UPLOAD_ERR_OK) {
        $gambar_tmp = $_FILES["gambar"]["tmp_name"];
        $gambar_name = $_FILES["gambar"]["name"];
        $gambarPath = "img/" . $gambar_name;
        
        move_uploaded_file($gambar_tmp, $gambarPath);
    }

    // Update data berita beserta gambar baru ke basis data
    $query = "UPDATE berita SET judul='$judul', ringkasan='$ringkasan'";

    if (!empty($gambarPath)) {
        $query .= ", path_gambar='$gambarPath'";
    }

    $query .= " WHERE id=$id";

    if ($conn->query($query) === TRUE) {
        echo "Berita berhasil diperbarui.";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    header("Location: admin.php");
}
?>
