<?php
include 'koneksi.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Hapus Kegiatan dari basis data
    $queryGetImagePath = "SELECT path_gambar FROM berita WHERE id=$id";
    $resultImagePath = $conn->query($queryGetImagePath);
    
    if ($resultImagePath->num_rows > 0) {
        $row = $resultImagePath->fetch_assoc();
        $imagePath = $row["path_gambar"];
        
        // Hapus gambar dari server
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    $query = "DELETE FROM berita WHERE id=$id";

    if ($conn->query($query) === TRUE) {
        echo "Berita berhasil dihapus.";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }

    header("Location: admin.php");
}
?>
