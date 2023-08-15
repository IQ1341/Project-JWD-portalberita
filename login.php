<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
  <title>Login Admin</title>
</head>
<body class="bg-gray-100">
  <div class="flex justify-center items-center h-screen">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-md">
        <a href="" class="flex item-center justify-center "><img src="img/logo BPSDMP.png" alt="" class="mr-3 border bg-white rounded-full " width="60px"></a>
        <h1 class="text-2xl font-bold mb-4 flex justify-center ">Login Admin</h1>
      <form action="proses_login.php" method="POST">
        <div class="mb-4">
          <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
          <input type="text" id="username" name="username" class="mt-1 p-2 border rounded w-full" required>
        </div>
        <div class="mb-4">
          <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
          <input type="password" id="password" name="password" class="mt-1 p-2 border rounded w-full" required>
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded w-full">Login</button>
      </form>
    </div>
  </div>
</body>
</html>
