<?php
session_start();
include "db_conn.php";

if (isset($_POST['email']) && isset($_POST['password1']) && isset($_POST['password2'])) {
    // removes backslashes
    $firstname = stripslashes($_POST['firstname']);
    //escapes special characters in a string
    $firstname = mysqli_real_escape_string($conn, $firstname);

    $lastname = stripslashes($_POST['lastname']);
    $lastname = mysqli_real_escape_string($conn, $lastname);

    $email    = stripslashes($_POST['email']);
    $email    = mysqli_real_escape_string($conn, $email);

    $password1 = stripslashes($_POST['password1']);
    $password1 = mysqli_real_escape_string($conn, $password1);

    $password2 = stripslashes($_POST['password2']);
    $password2 = mysqli_real_escape_string($conn, $password2);

    $create_datetime = date("Y-m-d H:i:s");

    // Check if passwords match
    if ($password1 !== $password2) {
        header("Location: register.php?error=Passwords do not match");
        exit();
    }

    // Hash the password
    $pass = password_hash($password1, PASSWORD_DEFAULT);

    // Check if the email is already registered
    $checkEmailQuery = "SELECT * FROM `customer` WHERE email=?";
    $stmt = mysqli_prepare($conn, $checkEmailQuery);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        header("Location: register.php?error=Email already exists");
        exit();
    } else {
        // Insert the new user into the database
        $query    = "INSERT into `customer` (first_name, last_name, password, email, create_datetime)
                     VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname , $pass, $email, $create_datetime);
        mysqli_stmt_execute($stmt);

        $_SESSION['email'] = $email;
        $_SESSION['first_name'] = $firstname;
        $_SESSION['id'] = mysqli_insert_id($conn);

        if ($result) {
            echo "
            <div class='registration-form'>
                <div class='min-h-screen flex items-center justify-center'>
                    <div class='bg-teal-100 p-10 rounded shadow-md'>
                    <h3 class='text-2xl text-center font-bold mb-4 text-teal-900'>You are registered successfully.</h3><br/>
                    <p class='link'>Click here to <a href='login.php'>Login</a></p>
                    
                    </div>
                </div>
            </div>";
        } else {
            echo "
            <div class='registration-form'>
                <div class='min-h-screen flex items-center justify-center'>
                    <div class='bg-teal-100 p-10 rounded shadow-md'>
                    <h3 class='text-2xl text-center font-bold mb-4 text-teal-900'>Required fields are missing.</h3><br/>
                    <p class='link'>Click here to <a href='login.php'>registration</a> again.</p>
                    </div>
                </div>
            </div>";
        }
    }
    ?>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Zumba With Davey</title>
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
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li><a href="#"></a></li>
                      <li><a href="./register.php">Register</a></li>
                      <li><a href="./login.php">Login</a></li>
                  </ul>
              </div>
          </nav>
      </header>

<!-- Registration Form HTML -->
<div class="min-h-screen flex items-center justify-center">
        <div class="bg-teal-100 p-10 rounded shadow-md">
            <!---------------- CLIENT LOGIN -------------->
            <p class="text-[10px] text-right font-bold mb-4 text-black">Already Registered? <a class="text-teal-500" href="./login.php">Login</a></p>
            <hr class="my-1">

            <!---------------- CLIENT REGISTRATION -------------->
            <h2 class="text-2xl text-center font-bold mb-4 text-teal-900">Registration</h2>
            <?php if (isset($_GET['error'])) { ?>
     				<p class="error"><?php echo $_GET['error']; ?></p>
     			<?php } ?>
            <form id="registration-form" action="./register.php" method="POST" onsubmit="checkPassword()">
                <div class="mb-2">
                    <input type="text" id="firstname" name="firstname" class="w-full border border-gray-300 rounded-full px-3 py-2" placeholder="First Name" required>
                </div>
                <div class="mb-2">
                  <input type="text" id="lastname" name="lastname" class="w-full border border-gray-300 rounded-full px-3 py-2" placeholder="Last Name" required>
                </div>
                <div class="mb-2">
                    <input type="email" id="email" name="email" class="w-full border border-gray-300 rounded-full px-3 py-2" placeholder="Email" required>
                </div>
                <div class="mb-2 relative">
                    <input type="password" id="password1" name="password1" class="w-full border border-gray-300 rounded-full px-3 py-2 pr-10" placeholder="Password" required>
                    <i class="fa fa-eye-slash eye_1 absolute top-10 right-3 cursor-pointer"></i>
                </div>
                <div class="mb-2 relative">
                    <input type="password" id="password2" name="password2" class="w-full border border-gray-300 rounded-full px-3 py-2 pr-10" placeholder="Confirm Password" required>
                    <i class="fa fa-eye-slash eye_1 absolute top-10 right-3 cursor-pointer"></i>
                </div>
                <div class="mb-2">
                    <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded-full hover:bg-teal-400">Register</button>
                </div>
            </form>
            <hr class="my-6">
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-teal-500 p-4 text-white text-center">
          &copy; 2023 Zumba With Davey
    </footer>
  </body>
</html>