<?php
session_start();
include "db_conn.php";

// Check if the user is logged in
if (isset($_SESSION['customer_id'])) {
    // User is logged in
    $navbarLinks = array(
        'Home' => './index.php',
        'Prices' => './prices.php',
        'My Account' => './myaccount.php',
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

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Retrieve user data by email
    $query = "SELECT * FROM `customer` WHERE email=?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['customer_id'] = $row['customer_id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['email'] = $row['email'];
            header("Location: myaccount.php");
            exit();
        } else {
            header("Location: login.php?error=Incorrect Email or password");
            exit();
        }
    } else {
        header("Location: login.php?error=Incorrect Email or password");
        exit();
    }
}
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
    <link rel="stylesheet" href="./css/style.css" />
</head>


<!-- Header -->
<header class="bg-teal-500 shadow p-5">
    <nav id="nav" role="navigation">
        <div class="container mx-auto p-4 flex flex-wrap items-center md:flex-no-wrap">
            <div class="mr-4 md:mr-8">
                <a href="#" rel="home">
                    <span class="text-xl text-white">Zumba with Davey</span>
                </a>
            </div>
            <div class="ml-auto md:hidden">
                <button onclick="menuToggle()" class="flex items-center px-3 py-2" type="button">
                    <svg class="h-5 w-5 text-white" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
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
                        echo '<li><a class="md:p-2 lg:px-4 font-semibold block text-teal-100 px-4 py-1 hover:text-teal-400 transition duration-100" href="' . $link . '">' . $text . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<body class="bg-gray-100">
    <svg class="fixed bottom-0 h-auto z-[-1] w-full" id="visual" viewBox="0 0 960 540" width="960" height="540" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1">
        <path d="M0 331L17.8 308.3C35.7 285.7 71.3 240.3 106.8 238.3C142.3 236.3 177.7 277.7 213.2 291.7C248.7 305.7 284.3 292.3 320 277.5C355.7 262.7 391.3 246.3 426.8 253C462.3 259.7 497.7 289.3 533.2 300.2C568.7 311 604.3 303 640 303.2C675.7 303.3 711.3 311.7 746.8 304.2C782.3 296.7 817.7 273.3 853.2 252.2C888.7 231 924.3 212 942.2 202.5L960 193L960 541L942.2 541C924.3 541 888.7 541 853.2 541C817.7 541 782.3 541 746.8 541C711.3 541 675.7 541 640 541C604.3 541 568.7 541 533.2 541C497.7 541 462.3 541 426.8 541C391.3 541 355.7 541 320 541C284.3 541 248.7 541 213.2 541C177.7 541 142.3 541 106.8 541C71.3 541 35.7 541 17.8 541L0 541Z" fill="#10bcb5"></path>
        <path d="M0 254L17.8 253C35.7 252 71.3 250 106.8 246.8C142.3 243.7 177.7 239.3 213.2 253C248.7 266.7 284.3 298.3 320 317.5C355.7 336.7 391.3 343.3 426.8 331.7C462.3 320 497.7 290 533.2 291.7C568.7 293.3 604.3 326.7 640 337.3C675.7 348 711.3 336 746.8 316.7C782.3 297.3 817.7 270.7 853.2 270C888.7 269.3 924.3 294.7 942.2 307.3L960 320L960 541L942.2 541C924.3 541 888.7 541 853.2 541C817.7 541 782.3 541 746.8 541C711.3 541 675.7 541 640 541C604.3 541 568.7 541 533.2 541C497.7 541 462.3 541 426.8 541C391.3 541 355.7 541 320 541C284.3 541 248.7 541 213.2 541C177.7 541 142.3 541 106.8 541C71.3 541 35.7 541 17.8 541L0 541Z" fill="#07a29e"></path>
        <path d="M0 380L17.8 380.3C35.7 380.7 71.3 381.3 106.8 383.2C142.3 385 177.7 388 213.2 382.3C248.7 376.7 284.3 362.3 320 361.3C355.7 360.3 391.3 372.7 426.8 363.2C462.3 353.7 497.7 322.3 533.2 312.7C568.7 303 604.3 315 640 314.5C675.7 314 711.3 301 746.8 307.5C782.3 314 817.7 340 853.2 345.7C888.7 351.3 924.3 336.7 942.2 329.3L960 322L960 541L942.2 541C924.3 541 888.7 541 853.2 541C817.7 541 782.3 541 746.8 541C711.3 541 675.7 541 640 541C604.3 541 568.7 541 533.2 541C497.7 541 462.3 541 426.8 541C391.3 541 355.7 541 320 541C284.3 541 248.7 541 213.2 541C177.7 541 142.3 541 106.8 541C71.3 541 35.7 541 17.8 541L0 541Z" fill="#038988"></path>
        <path d="M0 344L17.8 347.5C35.7 351 71.3 358 106.8 370.2C142.3 382.3 177.7 399.7 213.2 405.3C248.7 411 284.3 405 320 392.5C355.7 380 391.3 361 426.8 351.8C462.3 342.7 497.7 343.3 533.2 354.8C568.7 366.3 604.3 388.7 640 396.3C675.7 404 711.3 397 746.8 395.8C782.3 394.7 817.7 399.3 853.2 393.7C888.7 388 924.3 372 942.2 364L960 356L960 541L942.2 541C924.3 541 888.7 541 853.2 541C817.7 541 782.3 541 746.8 541C711.3 541 675.7 541 640 541C604.3 541 568.7 541 533.2 541C497.7 541 462.3 541 426.8 541C391.3 541 355.7 541 320 541C284.3 541 248.7 541 213.2 541C177.7 541 142.3 541 106.8 541C71.3 541 35.7 541 17.8 541L0 541Z" fill="#027171"></path>
        <path d="M0 431L17.8 430.5C35.7 430 71.3 429 106.8 418.5C142.3 408 177.7 388 213.2 384.8C248.7 381.7 284.3 395.3 320 395.8C355.7 396.3 391.3 383.7 426.8 388C462.3 392.3 497.7 413.7 533.2 425C568.7 436.3 604.3 437.7 640 438.3C675.7 439 711.3 439 746.8 438.3C782.3 437.7 817.7 436.3 853.2 432C888.7 427.7 924.3 420.3 942.2 416.7L960 413L960 541L942.2 541C924.3 541 888.7 541 853.2 541C817.7 541 782.3 541 746.8 541C711.3 541 675.7 541 640 541C604.3 541 568.7 541 533.2 541C497.7 541 462.3 541 426.8 541C391.3 541 355.7 541 320 541C284.3 541 248.7 541 213.2 541C177.7 541 142.3 541 106.8 541C71.3 541 35.7 541 17.8 541L0 541Z" fill="#025a5b"></path>
        <path d="M0 420L17.8 419.5C35.7 419 71.3 418 106.8 418.5C142.3 419 177.7 421 213.2 426.5C248.7 432 284.3 441 320 441.7C355.7 442.3 391.3 434.7 426.8 433.7C462.3 432.7 497.7 438.3 533.2 436C568.7 433.7 604.3 423.3 640 424.7C675.7 426 711.3 439 746.8 439.2C782.3 439.3 817.7 426.7 853.2 426.7C888.7 426.7 924.3 439.3 942.2 445.7L960 452L960 541L942.2 541C924.3 541 888.7 541 853.2 541C817.7 541 782.3 541 746.8 541C711.3 541 675.7 541 640 541C604.3 541 568.7 541 533.2 541C497.7 541 462.3 541 426.8 541C391.3 541 355.7 541 320 541C284.3 541 248.7 541 213.2 541C177.7 541 142.3 541 106.8 541C71.3 541 35.7 541 17.8 541L0 541Z" fill="#034345"></path>
        <path d="M0 461L17.8 462.2C35.7 463.3 71.3 465.7 106.8 469.2C142.3 472.7 177.7 477.3 213.2 478.3C248.7 479.3 284.3 476.7 320 471.7C355.7 466.7 391.3 459.3 426.8 460.7C462.3 462 497.7 472 533.2 477.2C568.7 482.3 604.3 482.7 640 482C675.7 481.3 711.3 479.7 746.8 480C782.3 480.3 817.7 482.7 853.2 481C888.7 479.3 924.3 473.7 942.2 470.8L960 468L960 541L942.2 541C924.3 541 888.7 541 853.2 541C817.7 541 782.3 541 746.8 541C711.3 541 675.7 541 640 541C604.3 541 568.7 541 533.2 541C497.7 541 462.3 541 426.8 541C391.3 541 355.7 541 320 541C284.3 541 248.7 541 213.2 541C177.7 541 142.3 541 106.8 541C71.3 541 35.7 541 17.8 541L0 541Z" fill="#032e30"></path>
    </svg>

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

    <!-- Login Form HTML -->
    <div class="flex justify-center px-30 py-40">
        <div class="rounded-lg shadow-lg p-20 backdrop-blur-lg bg-white/40">
            <!---------------- CLIENT LOGIN -------------->
            <p class="text-[10px] text-right font-bold mb-4 text-black">Don't have an Account? <a class="text-teal-500" href="./register.php">Register</a></p>
            <hr class="my-1">
            <h2 class="text-2xl text-center font-bold mb-4 text-teal-900">User Login</h2>
            <form action="login.php" method="POST">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <div class="mb-2">
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-full px-3 py-2" placeholder="Email" required>
                </div>
                <div class="mb-2">
                    <input type="password" id="loginPassword" name="password" class="w-full border border-gray-300 rounded-full px-3 py-2" placeholder="Password" required>
                </div>
                <div class="mb-2">
                    <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded-full hover:bg-teal-400">Login</button>
                </div>
            </form>
            <hr class="my-6">
        </div>
    </div>

  <!-- Footer -->
  <footer class="w-screen fixed bottom-0 mb-auto bg-teal-500 p-4 text-white text-center">
    &copy; 2023 Zumba With Davey
  </footer>
</body>

</html>