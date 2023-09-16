<?php
session_start();
include "db_conn.php";
include "config.php";

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
  <link rel="stylesheet" href="output.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <title>My Profile</title>
  <style>
    body {
      overflow: hidden;
      /* Prevent scrolling on the main page */
    }
  </style>
</head>

<nav class="z-50 backdrop-blur-lg lg:backdrop-blur-none py-4 px-8 absolute w-full top-0 from-white/20">
  <div class="container mx-auto p-4 flex flex-wrap items-center md:flex-no-wrap">
    <h1 class="text-white text-2xl font-bold">
      <a href="index.php" title="Home">ZUMBA WITH DAVEY</a>
    </h1>
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
    <div id="menu" class="overflow-hidden md:overflow-visible lg:overflow-visible w-full h-0 transition-all ease-out duration-500 md:transition-none md:w-auto md:flex-grow md:flex md:items-center">
      <ul id="ulMenu" class="flex flex-col duration-300 ease-out sm:transition-none mt-5 mx-4 md:flex-row md:items-center md:mx-0 md:ml-auto md:mt-0 md:pt-0 md:border-0">
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
    <img class="w-screen h-screen" src="images/stacked-peaks-haikei-_3_-min.jpeg" alt="" />
  </div>

  <script>
    // Getting hamburger menu in small screens
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

  <div class="px-10 py-32 sm:px-32 md:px-40 lg:px-60  grid grid-cols-1 row-span-2 sm:grid-cols-1  gap-5">
    <div class="bg-white rounded-lg shadow-lg p-6 col-span-1 sm:col-span-1  backdrop-blur-lg bg-white/20">
    <strong>Personal Details</strong><br>
      <?php if (is_user_logged_in()) {
        display_customer_details();?>
        <!-- Display user's profile information -->
        <h1 class="text-2xl font-semibold mb-4">
          <?php echo $first_name . ' ' . $last_name ?>
        </h1>
        <p>
          <strong>Phone Number:</strong>
          <?php echo $mobile_number ?>
        </p>
        <p>
          <strong>Email:</strong>
          <?php echo $email ?>
        </p>
        <a href="edit_profile.php">
        <button class="w-[85px] h-6 bg-rose-500 text-white hover:bg-rose-400 text-[12px] leading-tight rounded-md shadow-md hover:bg-lavender-700 hover:shadow-xl hover:scale-105 focus:bg-lavender-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-lavender-800 active:shadow-lg transition duration-150 ease-in-out">
          Update Details
        </button></a>
    </div>
    <div class="bg-white rounded-lg shadow-lg p-6 backdrop-blur-lg bg-white/20" id="concession">
      <div class="flex justify-between items-center">
        <div>
          <strong>Concessions</strong>
          <p>Available:</p>
          <?php echo $concessions ?>
        </div>

        <button id="useButton" class="w-20 h-20 bg-rose-500 text-white hover:bg-rose-400 font-medium text-xl leading-tight rounded-full shadow-md hover:bg-lavender-700 hover:shadow-xl hover:scale-105 focus:bg-lavender-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-lavender-800 active:shadow-lg transition duration-150 ease-in-out">
          Use
        </button>
      </div>
    <?php
      }
    ?>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 backdrop-blur-lg bg-white/20" id="notice">
      <div class="items-center">
        <strong>Buying More Concessions</strong>
        <p>
          To purchase more Concessions to attend classes, please buy in cash
          from Davey directly, and he will input your purchases into the
          website for you
        </p>
      </div>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6 col-span-1 backdrop-blur-lg bg-white/20" id="notice">
      <div class="flex flex-col"> <!-- Use flex-col to stack elements vertically -->
        <div class="mb-2"><strong>Personal Stats</strong></div>
        <div class="mb-2"><strong>Number of days attended</strong></div>
        <div><strong>You have attended the class ## times in a row!</strong></div>
      </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmationModal" class="fixed top-0 left-0 w-full h-full flex justify-center items-center bg-gray-800 bg-opacity-75 hidden ">
      <div class="bg-white rounded-lg shadow-lg p-6 w-96 ">
        <h2 class="text-2xl font-semibold mb-4">Confirm Concession Usage</h2>
        <p>Are you sure you want to use this concession?</p>
        <div class="mt-4 flex justify-end">
          <button id="cancelButton" class="px-4 py-2 bg-gray-400 text-white rounded-md mr-4 hover:bg-gray-600">
            Cancel
          </button>
          <button id="confirmButton" class="px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600">
            Confirm
          </button>
        </div>
      </div>
    </div>

    <!-- JavaScript to control modal visibility -->
    <script>
      // Get modal elements and buttons by ID
      const confirmationModal = document.getElementById("confirmationModal");
      const confirmButton = document.getElementById("confirmButton");
      const cancelButton = document.getElementById("cancelButton");

      // Function to show the modal
      function showConfirmationModal() {
        confirmationModal.classList.remove("hidden");
      }

      // Function to hide the modal
      function hideConfirmationModal() {
        confirmationModal.classList.add("hidden");
      }

      // Event listener for the "Use" button
      const useButton = document.getElementById("useButton");
      useButton.addEventListener("click", showConfirmationModal);

      // Event listeners for the modal buttons
      confirmButton.addEventListener("click", function() {
        // Handle confirmation logic here (e.g., marking concession as used)
        // After handling, hide the modal
        hideConfirmationModal();
      });

      cancelButton.addEventListener("click", hideConfirmationModal);
    </script>
  </div>
  <!-- Footer -->
  <footer class="w-screen fixed bottom-0 mb-auto bg-rose-500 p-4 text-white text-center">
    &copy; 2023 Zumba With Davey
  </footer>
</body>

</html>