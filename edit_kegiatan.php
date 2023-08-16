<?php include 'session.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <title>Dashboard Admin</title>
</head>
<body class="bg-gray-100">

  <nav class="bg-blue-800 py-4">
    <div class="container mx-auto flex justify-between items-center">
    <a href="index.php"><img src="img/logo BPSDMP.png" alt="" class="mr-3 border bg-white rounded-full" width="50px"></a>
      <div class="flex items-center space-x-4">
        <img src="log-svg/logo.svg" alt="Admin Image" class="w-8 h-8 rounded-full">
        <span class="text-white"><?php echo $adminName; ?></span>
        <a href="?logout=1" class="bg-red-500 hover:bg-red-600 text-white px-2 py-2 rounded flex ">Logout<span class="material-symbols-outlined px-2">logout</span></a>
      </div>
    </div>
  </nav>
  
  <div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

<div class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="w-full max-w-sm bg-white p-8 rounded shadow">
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

        echo '<form id="editForm" method="POST" enctype="multipart/form-data" class="flex flex-col space-y-4">';   
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

        echo '<div class="flex justify-end">'; 
        echo '<a href="admin.php" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 mr-2 rounded">Batal</a>';
        echo '<button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>';
        echo '</div>';
        echo '</form>';
      } else {
        echo '<p class="text-gray-600">Kegiatan Masih Kososng.</p>';
      }
    }
    ?>
  </div>
  <script src="js/script.js"></script>
</body>
</html>