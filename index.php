<?php
include 'koneksi.php'; // Memanggil file koneksi.php

// Query untuk mengambil data berita dan mengurutkannya berdasarkan tanggal publikasi (terbaru ke yang lebih lama)
$query = "SELECT * FROM berita ORDER BY tanggal_publikasi DESC";
$result = $conn->query($query);

function truncateText($text, $length) {
    if (strlen($text) > $length) {
        $text = substr($text, 0, $length);
        $text = substr($text, 0, strrpos($text, ' ')) . '...';
    }
    return $text;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
  <title>BPSDMP-Kominfo-surabaya</title>
</head>
<body class="bg-gray-100">
  <header class="flex justify-center ">
        <nav class="self-center w-full max-w-7xl  ">
            <div class="flex flex-col  justify-around items-center md:items-start border-b-2">
                <div class="flex justify-center items-center">
                    <nav class=" fixed top-0 left-0 w-full bg-blue-800 shadow-sm z-50 p-2  ">
                        <div class="flex flex-col justify-around items-center md:items-start w-full ">
                            <div class="flex items-center uppercase py-3 text-2xl font-sans font-bold px-20">
                                <a href=""><img src="img/logo BPSDMP.png" alt="" class="mr-3 border bg-white rounded-full" width="60px"></a>
                                <div class="hidden md:block">
                                <h1 class="uppercase text-xl font-sans font-bold text-white">BPSDMP</h1>
                                <h2 class="uppercase text-sm font-sans font-bold text-white">Balai Pengembangan Sumber Daya Manusia dan Penelitian Komunikasi dan Informatika Surabaya</h2>
                                <p class="uppercase text-sm font-sans font-semibold text-gray-400">Badan Penelitian dan Pengembangan Sumber Daya Manusia - Kementerian Komunikasi dan Informatika Republik Indonesia</p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-700 fixed  left-0 w-full">
                        <ul class="flex items-center  text-sm md:text-[18px] font-bold md:px-20 text-gray-300">
                            <!-- Daftar item navigasi -->
                            <li
                            class="hover:bg-gray-600 underline-offset-4 decoration-2 decoration-cyan-500 py-2  px-2 md:px-5 flex ">
                            <a href="home.html">Home</a>
                        </li>
                        <li
                            class="hover:bg-gray-600 underline-offset-4 decoration-2 decoration-cyan-500 py-2  px-2 md:px-5">
                            <a href="aboute.php">About</a>
                        </li>
                        <li
                            class="hover:bg-gray-600 underline-offset-4 decoration-2 decoration-cyan-500 py-2  px-2 md:px-5 right-0">
                            <a href="admin.php">login</a>
                        </li>
                        </ul>
                        
                        </div>
                    </nav>
                </div>
            </div>
        </nav>
  </header>
  <section class="container mx-auto mt-36">
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
  <!-- Berita Utama -->
  <?php
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo '
                <div class="md:col-span-1 bg-white p-4 shadow-md rounded-lg">
                <div class="flex text-gray-500 text-sm ">
                <div class="m-1 font-bold">Admin.</div>
                <div class="m-1">' . date('d M Y H:i', strtotime($row["tanggal_publikasi"])) .  '</div>
                </div>
                    <img src="' . $row["path_gambar"] . '" alt="Gambar Berita Utama" class="w-full h-60 object-cover rounded">
                    <h2 class="text-xl font-semibold mt-2">' . $row["judul"] . '</h2>
                    <p class="text-gray-600 mt-2">' . $row["ringkasan"] . '</p>
                    
                </div>';
            }
            ?>
<!-- Berita Lainnya -->
<div class="md:col-span-1 grid grid-cols-2 gap-4">
<?php
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="bg-white p-4 shadow-md rounded-lg ">
                <div class="flex text-gray-500 text-sm ">
                <div class="m-1 font-bold">Admin.</div>
                <div class="m-1">' . date('d M Y H:i', strtotime($row["tanggal_publikasi"])) .  '</div>
                </div>
                    <img src="' . $row["path_gambar"] . '" alt="Gambar Artikel" class="w-full h-40 object-cover rounded">
                    <h2 class="text-lg font-semibold mt-2">' . $row["judul"] . '</h2>
                    <p class="text-gray-600 mt-2">' . truncateText($row["ringkasan"], 50) . '</p>
                    <a href="#" class="text-blue-500 hover:underline mt-4 inline-block">Selengkapnya &rarr;</a>
                </div>';
            }
            ?>
        </div>
    </section>
  

</body>
</html>
