<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <title>Dashboard Admin || Add</title>
</head>
<body>
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
</body>
</html>