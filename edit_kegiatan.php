<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
  <title>Dashboard Admin || Edit</title>
</head>
<body class="bg-gray-100">
  <div class="container mx-auto p-8">
    <?php
    include 'koneksi.php';

    if (isset($_GET["id"])) {
      $id = $_GET["id"];
      
      // Query untuk mengambil data berita berdasarkan id
      $query = "SELECT * FROM berita WHERE id=$id";
      $result = $conn->query($query);
      
      if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();

        echo '<h1 class="text-2xl font-bold mb-4">Edit Berita</h1>';

        echo '<form action="proses_edit_kegiatan.php" method="POST" enctype="multipart/form-data" class="w-full max-w-lg">';
        echo '<input type="hidden" name="id" value="' . $id . '">'; // Untuk menyimpan id berita

        echo '<div class="mb-4">';
        echo '<label class="block text-gray-700 text-sm font-bold mb-2">Judul</label>';
        echo '<input type="text" name="judul" class="w-full p-2 rounded border" value="' . $data["judul"] . '">';
        echo '</div>';

        echo '<div class="mb-4">';
        echo '<label class="block text-gray-700 text-sm font-bold mb-2">Ringkasan</label>';
        echo '<textarea name="ringkasan" class="w-full p-2 rounded border h-20">' . $data["ringkasan"] . '</textarea>';
        echo '</div>';


        echo '<div class="mb-4">';
        echo '<label class="block text-gray-700 text-sm font-bold mb-2">Gambar Sekarang</label>';
        echo '<img src="' . $data["path_gambar"] . '" alt="Gambar Berita" class="w-32 h-32 object-cover">';
        echo '</div>';

        echo '<div class="mb-4">';
        echo '<label class="block text-gray-700 text-sm font-bold mb-2">Pilih Gambar Baru</label>';
        echo '<input type="file" name="gambar" class="w-full">';
        echo '</div>';

        // Lanjutkan dengan tombol submit

        echo '<div class="flex justify-end">';
        echo '<button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>';
        echo '</div>';
        echo '</form>';
      } else {
        echo '<p class="text-gray-600">Kegiatan Masih Kososng.</p>';
      }
    }
    ?>
  </div>
</body>
</html>
