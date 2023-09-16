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

    <?php
    if (is_user_logged_in()) {
        display_customer_details(); // Assuming this function fetches user details.
    
        // Fetch user details from the database
        $query = "SELECT * FROM `customer` WHERE email=?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            // Extract user details
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $gender = $row['gender'];
            $date_of_birth = $row['date_of_birth'];
            $mobile_number = $row['phone'];

            ?>
            <div class="flex justify-center px-40 py-40">
                <div class="w-[30rem] rounded-lg shadow-lg p-10 backdrop-blur-lg bg-white/40">
                    <h2 class="text-2xl text-left font-bold mb-4 text-rose-500">Welcome,
                        <?php echo $first_name; ?>!
                    </h2>

                    <!-- Profile Update Form -->
                    <form action="update_profile.php" method="post">
                        <div class="mb-4">
                            <label for="first_name" class="block text-black font-semibold">First Name</label>
                            <input class="w-full px-3 py-2 border rounded-md" type="text" id="first_name" name="first_name"
                                value="<?php echo $first_name ?>">
                        </div>
                        <div class="mb-4">
                            <label for="last_name" class="block text-black font-semibold">Last Name</label>
                            <input class="w-full px-3 py-2 border rounded-md" type="text" id="last_name" name="last_name"
                                value="<?php echo $last_name; ?>">
                        </div>
                        <div class="mb-4">
                            <label for="gender" class="block text-black font-semibold">Gender</label>
                            <select id="gender" name="gender" class="w-full px-3 py-2 border rounded-md">
                                <option value="" <?= empty($gender) ? 'selected' : '' ?>></option>
                                <option value="M" <?= ($gender == 'M') ? 'selected' : '' ?>>Male</option>
                                <option value="F" <?= ($gender == 'F') ? 'selected' : '' ?>>Female</option>
                                <option value="GD" <?= ($gender == 'GD') ? 'selected' : '' ?>>Other</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="date_of_birth" class="block text-black font-semibold">Date of Birth</label>
                            <input class="w-full px-3 py-2 border rounded-md" type="date" id="date_of_birth"
                                name="date_of_birth" value="<?php echo isset($date_of_birth) ? $date_of_birth : ''; ?>">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-black font-semibold">Email</label>
                            <input class="w-full px-3 py-2 border rounded-md" type="email" id="email" name="email"
                                value="<?php echo $email; ?>">
                        </div>
                        <div class="mb-4">
                            <label for="mobile_number" class="block text-black font-semibold">Mobile Number</label>
                            <input class="w-full px-3 py-2 border rounded-md" type="text" id="mobile_number"
                                name="mobile_number" value="<?php echo isset($mobile_number) ? $mobile_number : ''; ?>">
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-rose-500 text-white px-4 py-2 rounded-md hover:bg-rose-400">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
            <?php
        }
    }
    ?>

    <!-- Footer -->
    <footer class="w-screen fixed bottom-0 mb-auto bg-rose-500 p-4 text-white text-center">
        &copy; 2023 Zumba With Davey
    </footer>
</body>

</html>