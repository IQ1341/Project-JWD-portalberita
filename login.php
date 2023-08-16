<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
  <title>Login Admin</title>
</head>
<body class="bg-gray-100">
<div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="loginModal">
  <div class="absolute inset-0 bg-black opacity-60 "></div>
  <div class="absolute inset-0 flex items-center justify-center">
    <div class="bg-white p-4 rounded shadow w-96">
      <a class="flex justify-center" href="index.php"><img width="60px" src="img/logo BPSDMP.png" alt=""></a>
      <h1 class="text-2xl font-bold mb-4 flex  justify-center">Login Admin</h1>
      <form action="proses_login.php" method="post" target="_blank">
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Username</label>
          <input type="text" name="username" class="mt-1 p-2 w-full border rounded">
        </div>
        <div class="mb-4">
          <label class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" name="password" class="mt-1 p-2 w-full border rounded">
        </div>
        <div class="flex justify-end">
          <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Login</button>
          <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded ml-2" onclick="closeLoginModal()">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="js/script.js"></script>
</body>
</html>

