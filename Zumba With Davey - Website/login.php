<?php
session_start();
include "db_conn.php";

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
        include "config.php";
        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['customer_id'] = $row['customer_id'];
            $_SESSION['first_name'] = $row['first_name'];
            $_SESSION['last_name'] = $row['last_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['gender'] = $row['gender'];
            $_SESSION['phone'] = $row['phone'];
            $_SESSION['date_of_birth'] = $row['date_of_birth'];
            $_SESSION['no_concession'] = $row['no_concession'];
            header("Location: myprofile.php");
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
    <title>Prices</title>
    <link rel="stylesheet" href="output.css" />
    <script src="https://cdn.tailwindcss.com"></script>
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
            <p class="text-[10px] text-right font-bold mb-4 text-black">Don't have an Account? <a class="text-rose-500" href="./register.php">Register</a></p>
            <hr class="my-1">
            <h2 class="text-2xl text-center font-bold mb-4 text-rose-500">User Login</h2>
            <form action="login.php" method="POST">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <div class="mb-2">
                    <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-md" placeholder="Email" required>
                </div>
                <div class="mb-2">
                    <input type="password" id="loginPassword" name="password" class="w-full px-3 py-2 border rounded-md" placeholder="Password" required>
                </div>
                <div class="mb-2">
                    <button type="submit" class="bg-rose-500 text-white px-4 py-2 rounded-full hover:bg-rose-400">Login</button>
                </div>
            </form>
            <hr class="my-6">
        </div>
    </div>

    <!-- Footer -->
    <footer class="w-screen fixed bottom-0 mb-auto bg-rose-500 p-4 text-white text-center">
        &copy; 2023 Zumba With Davey
    </footer>
</body>

</html>