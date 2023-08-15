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
    header("Location: login.php");
    exit();
}

include 'koneksi.php'; // Sertakan file koneksi.php atau sesuaikan dengan cara Anda

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
    <a href=""><img src="img/logo BPSDMP.png" alt="" class="mr-3 border bg-white rounded-full" width="50px"></a>
      <div class="flex items-center space-x-4">
        <img src="log-svg/logo.svg" alt="Admin Image" class="w-8 h-8 rounded-full">
        <span class="text-white"><?php echo $adminName; ?></span>
        <a href="?logout=1" class="bg-red-500 hover:bg-red-600 text-white px-2 py-2 rounded flex ">Logout<span class="material-symbols-outlined px-2">logout</span></a>
      </div>
    </div>
  </nav>
  
  <div class="container mx-auto p-8">
    <h1 class="text-2xl font-bold mb-4">Dashboard Admin</h1>

    <a  href="javascript:void(0);" onclick="openModal()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded ">Tambah Kegiatan</a>

    <div class="mt-4">
      <table class="min-w-full table-auto border-collapse border border-gray-300">
        <thead class="bg-gray-200">
          <tr>
            <th class="border p-2">Gambar</th>
            <th class="border p-2">Judul</th>
            <th class="border p-2">Ringkasan</th>
            <th class="border p-2">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include 'koneksi.php';

          $query = "SELECT * FROM berita ORDER BY tanggal_publikasi DESC";
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo '<tr class="border">';
              echo '<td class="border p-2"><img src="' . $row["path_gambar"] . '" alt="Gambar Berita" class="w-16 h-16 object-cover"></td>';
              echo '<td class="border p-2">' . $row["judul"] . '</td>';
              echo '<td class="border p-2">' . substr($row["ringkasan"], 0, 50) . '...</td>';
              echo '<td class="pt-4 flex items-center justify-center">';
              echo '<a href="edit_kegiatan.php?id=' . $row["id"] . '" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mr-2">Edit</a>';
              echo '<a href="javascript:void(0);" onclick="confirmDelete(' . $row["id"] . ')" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Hapus</a>';
              echo '</td>';
              echo '</tr>';
            }
          } else {
            echo '<tr><td colspan="4" class="text-center">Tidak ada kegiatan.</td></tr>';
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>


<!-- bagian tambah kegiatan -->

<div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="modal">
  <div class="absolute inset-0 bg-black opacity-60"></div>
  <div class="absolute inset-0 flex items-center justify-center">
    <div class="bg-white p-4 rounded shadow">
      <h1 class="text-2xl font-bold mb-4">Tambah Kegiatan</h1>
      <form action="proses_tambah_kegiatan.php" method="post" enctype="multipart/form-data">
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Judul</label>
        <input type="text" name="judul" class="mt-1 p-2 w-full border rounded">
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Ringkasan</label>
        <textarea name="ringkasan" class="mt-1 p-2 w-full border rounded" rows="3"></textarea>
      </div>
      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700">Gambar</label>
        <input type="file" name="gambar" class="mt-1">
      </div>
        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Tambah</button>
          <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded ml-2" onclick="closeModal()">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- edit kegiatan -->
<div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="editModal">
    <div class="absolute inset-0 bg-black opacity-60"></div>
    <div class="absolute bg-white p-8 rounded shadow w-full max-w-lg">
      <h1 class="text-2xl font-bold mb-4">Edit Kegiatan</h1>
      <form id="editForm" action="proses_edit_kegiatan.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" id="editId">
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Judul</label>
          <input type="text" name="judul" class="w-full p-2 rounded border" value="<?php echo $data["judul"]; ?>">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Ringkasan</label>
          <textarea name="ringkasan" class="w-full p-2 rounded border h-20"><?php echo $data["ringkasan"]; ?></textarea>
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Gambar Sekarang</label>
          <img src="<?php echo $data["path_gambar"]; ?>" alt="Gambar Berita" class="w-32 h-32 object-cover">
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">Pilih Gambar Baru</label>
          <input type="file" name="gambar" class="w-full">
        </div>

        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Simpan Perubahan</button>
          <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded ml-2" onclick="closeEditModal()">Batal</button>
        </div>
      </form>
    </div>
  </div>
<script>
  function openEditModal(id) {
    document.getElementById("editId").value = id; // Set id berita yang akan diedit
    document.getElementById("editModal").classList.remove("hidden");
    // Ambil data berita dari server berdasarkan id dan isi form dengan data tersebut
    // Misalnya menggunakan AJAX request
  }

  function closeEditModal() {
    document.getElementById("editModal").classList.add("hidden");
  }
</script>
  <script>
  function openModal() {
    document.getElementById("modal").classList.remove("hidden");
  }

  function closeModal() {
    document.getElementById("modal").classList.add("hidden");
  }

</script>

  <script>
    function confirmDelete(id) {
      if (confirm("Apakah Anda yakin ingin menghapus kegiatan ini?")) {
        window.location.href = "proses_hapus_kegiatan.php?id=" + id;
      }
    }
  </script>
</body>
</html>
