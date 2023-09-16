<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['customer_id'])) {
  // User is logged in
  $navbarLinks = array(
    'Home' => './index.php',
    'Prices' => './prices.php',
    'My Account' => './myprofile.php',
    'Logout' => './logout.php' // Add a logout link
  );
} else {
  // User is not logged in
  $navbarLinks = array(
    'Home' => './index.php',
    'Prices' => './prices.php',
    'Register' => './register.php',
    'Login' => './login.php'
  );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Prices</title>
  <link rel="stylesheet" href="output.css" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<nav class="z-50 backdrop-blur-lg lg:backdrop-blur-none py-4 px-8 absolute w-full top-0 from-white/20">
    <div class="container mx-auto p-4 flex flex-wrap items-center md:flex-no-wrap">
      <h1 class="text-white text-2xl font-bold">
        <a href="index.php" title="Home">ZUMBA WITH DAVEY</a></h1>
      <style>
        h1 {
          text-shadow: 2px 2px #ca1a7e;
        }
      </style>
      <div class="mr-4 md:mr-8"></div>
      <div class="ml-auto md:hidden">
        <button onclick="menuToggle()" class="flex items-center px-2 py-2" type="button">
          <svg class="h-10 w-10 text-black" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <title>Menu</title>
            <path fill="currentColor" d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
          </svg>
        </button>
      </div>
      <div id="menu"
        class="overflow-hidden md:overflow-visible lg:overflow-visible w-full h-0 transition-all ease-out duration-500 md:transition-none md:w-auto md:flex-grow md:flex md:items-center">
        <ul id="ulMenu"
          class="flex flex-col duration-300 ease-out sm:transition-none mt-5 mx-4 md:flex-row md:items-center md:mx-0 md:ml-auto md:mt-0 md:pt-0 md:border-0">
          <?php
          // Loop through the $navbarLinks array to generate navbar links
          foreach ($navbarLinks as $text => $link) {
            echo '<li><a class="hover:bg-white hover:shadow-md rounded-full md:p-2 lg:px-4 font-semibold block text-black px-4 py-1 hover:text-black transition duration-100" href="' . $link . '">' . $text . '</a></li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>

<body class="bg-white">
    <style></style>
    <div class="fixed w-full h-auto">
      <img
        class="w-screen h-screen"
        src="images/stacked-peaks-haikei-_3_-min.jpeg"
        alt=""
      />
    </div>

  <script>
    // Getting hamburguer menu in small screens
    const menu = document.getElementById("menu");
    const ulMenu = document.getElementById("ulMenu");

    function menuToggle() {
      menu.classList.toggle("h-auto"); // Toggle the height property
      menu.classList.toggle("max-h-screen"); //

    }

    // Browser resize listener
    window.addEventListener("resize", menuResize);

    // Resize menu if user changing the width with responsive menu opened
    function menuResize() {
      // First get the size from the window
      const window_size = window.innerWidth || document.body.clientWidth;
      if (window_size > 640) {
        menu.classList.remove("h-32");
      }
    }
  </script>

  <div class="py-52 px-10 sm:py-32 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <div
      class="bg-white rounded-lg shadow-lg p-6 col-span-1 sm:col-span-1 md:col-span-1 lg:col-span-3 backdrop-blur-lg bg-white/20"
      id="notice">
      <div class="flex flex-col justify-center items-center">
        <!-- Use flex-col to stack elements vertically -->
        <strong>Concession Deals</strong>
        <p class="text-center">
          We have a range of deals to get the best prices!
        </p>
        <p class="text-center">
          Please remember that to buy more concessions, see Davey in person
          and he will happily top you up
        </p>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 col-span-1 relative overflow-hidden backdrop-blur-lg bg-white/20"
      id="notice">
      <div class="flex flex-col justify-center items-center">
        <strong class="p-5 text-2xl">One Concession</strong>
        <strong class="text-4xl p-16">$10</strong>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 col-span-1 relative overflow-hidden backdrop-blur-lg bg-white/20"
      id="notice">
      <div class="flex flex-col justify-center items-center">
        <strong class="p-5 text-2xl">5 Concession</strong>
        <strong class="text-4xl p-16">$40</strong>
      </div>
      <div class="absolute -bottom-4 -right-20 bg-rose-500 px-20 pb-16 pt-2 -rotate-45">
        <strong class="text-white">Save $10!</strong>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 col-span-1 relative overflow-hidden backdrop-blur-lg bg-white/20"
      id="notice">
      <div class="flex flex-col justify-center items-center">
        <strong class="p-5 text-2xl text-center">Ten Concession Bundle</strong>
        <strong class="text-4xl p-16">$75</strong>
      </div>
      <div class="absolute -bottom-4 -right-20 bg-rose-500 px-20 pb-16 pt-2 -rotate-45">
        <strong class="text-white">Save $25!</strong>
      </div>
    </div>
  </div>
  
  <!-- Footer -->
  <footer class="w-screen fixed bottom-0 mb-auto bg-rose-500 p-4 text-white text-center">
    &copy; 2023 Zumba With Davey
  </footer>
</body>
</html>