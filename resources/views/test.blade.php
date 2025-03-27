<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tailwind CSS Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

  <!-- Navbar -->
  <nav class="fixed top-0 left-0 w-full bg-white shadow-md z-50">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
      <div class="text-xl font-bold text-gray-800">MyApp</div>
      <div class="flex space-x-4">
        <a href="#" class="text-gray-600 hover:text-gray-800">Home</a>
        <a href="#" class="text-gray-600 hover:text-gray-800">About</a>
        <a href="#" class="text-gray-600 hover:text-gray-800">Contact</a>
      </div>
    </div>
  </nav>

  <!-- Posts Section -->
  <div class="pt-20">
    <div class="container mx-auto px-6">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Post 1 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <img
            src="https://via.placeholder.com/800x400"
            alt="Post Image"
            class="w-full h-auto object-cover"
          >
          <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Post Title 1</h2>
            <p class="text-gray-600">This is a short description of the post. It provides a brief overview of the content.</p>
          </div>
        </div>

        <!-- Post 2 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <img
            src="https://via.placeholder.com/800x400"
            alt="Post Image"
            class="w-full h-auto object-cover"
          >
          <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Post Title 2</h2>
            <p class="text-gray-600">This is a short description of the post. It provides a brief overview of the content.</p>
          </div>
        </div>

        <!-- Post 3 -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <img
            src="https://via.placeholder.com/800x400"
            alt="Post Image"
            class="w-full h-auto object-cover"
          >
          <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Post Title 3</h2>
            <p class="text-gray-600">This is a short description of the post. It provides a brief overview of the content.</p>
          </div>
        </div>

        <!-- Add more posts as needed -->
      </div>
    </div>
  </div>

</body>
</html>
