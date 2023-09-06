<?php
// Include auth_session.php file for session management
include("auth_session.php");

// Check if the user is logged in
if (isset($_SESSION['customer_id'])) {
    // User is logged in
    $navbarLinks = array(
        'Home' => './index.php',
        'About' => '#',
        'Classes' => '#',
        'Contact' => '#',
        '' => '#',
        ' ' => '#',
        '  ' => '#',
        'My Account' => './myaccount.php',
        'Logout' => './logout.php' // Add a logout link
    );
} else {
    // User is not logged in
    $navbarLinks = array(
        'Home' => './index.php',
        'About' => '#',
        'Classes' => '#',
        'Contact' => '#',
        '' => '#',
        ' ' => '#',
        '  ' => '#',
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
    <link rel="stylesheet" href="./css/style.css" />

<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-teal-500 p-5">
        <nav class="container mx-auto flex justify-between items-center">
            <div class="text-white text-2xl font-bold">Zumba With Davey</div>
            <div class="md:hidden">
                <!-- Mobile menu button (navbar-burger) -->
                <button id="mobile-menu-button" class="text-teal-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                        <path d="M2.5 4.5a.5.5 0 0 1 .5-.5h12a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zM2.5 9a.5.5 0 0 0 .5.5h12a.5.5 0 0 0 0-1H3a.5.5 0 0 0-.5.5zM2.5 13.5a.5.5 0 0 1 .5-.5h12a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>
                <!-- Mobile menu (hidden by default) -->
                <div id="mobile-menu" class="hidden">
                    <ul class="text-white text-xl font-semibold">
                        <?php
                        // Loop through the $navbarLinks array to generate navbar links
                        foreach ($navbarLinks as $text => $link) {
                            echo '<li><a href="' . $link . '">' . $text . '</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block">
                <!-- Desktop menu -->
                <ul class="flex space-x-4 text-white text-xl font-semibold">
                    <?php
                    // Loop through the $navbarLinks array to generate navbar links
                    foreach ($navbarLinks as $text => $link) {
                        echo '<li><a href="' . $link . '">' . $text . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>
    </head>


    <body>
        <?php if (isset($_SESSION['customer_id'])) { ?>
            <div class="min-h-screen flex items-center justify-center">
                <div class="bg-teal-100 p-10 rounded shadow-md">
                    <h2 class="text-2xl text-left font-bold mb-4 text-teal-900">Welcome, <?php echo $_SESSION['first_name']; ?>!</h2>

                    <!-- Profile Update Form -->
                    <form action="update_profile.php" method="post">
                        <div class="mb-4">
                            <label for="first_name" class="block text-teal-900 font-semibold">First Name</label>
                            <input class="w-full px-3 py-2 border rounded-md" type="text" id="first_name" name="first_name" value="<?php echo $_SESSION['first_name']; ?>">
                        </div>
                        <div class="mb-4">
                            <label for="last_name" class="block text-teal-900 font-semibold">Last Name</label>
                            <input class="w-full px-3 py-2 border rounded-md" type="text" id="last_name" name="last_name" value="<?php echo $_SESSION['last_name']; ?>">
                        </div>
                        <div class="mb-4">
                            <label for="gender" class="block text-teal-900 font-semibold">Gender</label>
                            <select id="gender" name="gender" class="w-full px-3 py-2 border rounded-md">
                                <option value="" <?php if (empty($_SESSION['gender'])) echo 'selected'; ?>></option>
                                <option value="Male" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Male') echo 'selected'; ?>>Male</option>
                                <option value="Female" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Female') echo 'selected'; ?>>Female</option>
                                <option value="Other" <?php if (isset($_SESSION['gender']) && $_SESSION['gender'] === 'Other') echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="date_of_birth" class="block text-teal-900 font-semibold">Date of Birth</label>
                            <input class="w-full px-3 py-2 border rounded-md" type="date" id="date_of_birth" name="date_of_birth" value="<?php if (isset($_SESSION['date_of_birth'])) echo $_SESSION['date_of_birth']; ?>">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-teal-900 font-semibold">Email</label>
                            <input class="w-full px-3 py-2 border rounded-md" type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                        </div>
                        <div class="mb-4">
                            <label for="mobile_number" class="block text-teal-900 font-semibold">Mobile Number</label>
                            <input class="w-full px-3 py-2 border rounded-md" type="text" id="mobile_number" name="mobile_number" value="<?php if (isset($_SESSION['phone'])) echo $_SESSION['phone']; ?>">
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded-md">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php
        }
        ?>

        <!-- Footer -->
        <footer class="bg-teal-500 p-4 text-white text-center">
            &copy; 2023 Zumba With Davey
        </footer>
    </body>

</html>