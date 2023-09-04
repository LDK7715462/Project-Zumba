<?php
//include auth_session.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zumba With Davey - Home</title>
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/output.css">
    <script scr="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script scr="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script scr="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/mobile-menu.js"></script>
    <link rel="stylesheet" href="./css/output.css">
    <link rel="stylesheet" href="./css/style.css"/>

    <body class="bg-gray-100">
      <!-- Header -->
      <header class="bg-teal-500 p-5">
          <nav class="container mx-auto flex justify-between items-center">
              <div class="text-white text-2xl font-bold">Zumba With Davey</div>
              <div class="md:hidden">
                  <!-- Mobile menu button (navbar-burger) -->
                  <button id="mobile-menu-button" class="text-teal-100">
                      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                          <path d="M2.5 4.5a.5.5 0 0 1 .5-.5h12a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zM2.5 9a.5.5 0 0 0 .5.5h12a.5.5 0 0 0 0-1H3a.5.5 0 0 0-.5.5zM2.5 13.5a.5.5 0 0 1 .5-.5h12a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                      </svg>
                  </button>
                  <!-- Mobile menu (hidden by default) -->
                  <div id="mobile-menu" class="hidden">
                      <ul class="text-white text-xl font-semibold">
                          <li class="py-2">Home</li>
                          <li class="py-2">About</li>
                          <li class="py-2">Classes</li>
                          <li class="py-2">Contact</li>
                          <li class="py-2"></li>
                          <li class="py-2"><a href="./register.php">Register</a></li>
                          <li class="py-2"><a href="./login.php">Login</a></li>
                      </ul>
                  </div>
              </div>
              <div class="hidden md:block">
                  <!-- Desktop menu -->
                  <ul class="flex space-x-4 text-white text-xl font-semibold">
                      <li><a href="./index.php">Home</a></li>
                      <li><a href="#">About</a></li>
                      <li><a href="#">Classes</a></li>
                      <li><a href="#">Contact</a></li>
                      <li><a href="#"></a></li>
                      <li></li>
                      <li></li>
                      <li><a href="./logout.php">Logout</a></li>
                  </ul>
              </div>
          </nav>
      </header>
</head>

<body>
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-teal-100 p-10 rounded shadow-md">
            <h2 class="text-2xl text-left font-bold mb-4 text-teal-900">Welcome!</h2>
            <?php if (isset($_SESSION['customer_id'])) { ?>
                <p><strong><?php echo $_SESSION['first_name'];?> <?php echo $_SESSION['last_name'];?></strong></p>
                <p>You are now at the user dashboard page.</p>
                <?php } ?>
            <hr class="my-6">
        </div>
    </div>


    <!-- Footer -->
    <footer class="bg-teal-500 p-4 text-white text-center">
          &copy; 2023 Zumba With Davey
    </footer>
  </body>
</html>