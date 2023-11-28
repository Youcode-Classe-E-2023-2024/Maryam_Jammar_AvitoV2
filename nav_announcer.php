<?php
if (session_status() == PHP_SESSION_NONE) {
    // Vérifiez si la session n'est pas déjà active
    session_start();
}

// Vérifiez si l'utilisateur est connecté et que la session 'username' est définie
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>

<body>
    <style>
        /* Add your custom styles here */
        nav {
            background: rgb(238, 174, 202);
            background: radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(163, 148, 233, 1) 100%);
        }
    </style>

    <style>
        .dropdown-menu {
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 8px;
            z-index: 1;
        }

        .dropdown-menu a {
            display: block;
            padding: 8px;
            text-decoration: none;
            color: #333;
        }

        .dropdown-menu a:hover {
            background-color: #f5f5f5;
        }

        .hidden {
            display: none;
        }
    </style>

    <nav class="bg-blue-100 border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="announces.php" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="images/logo.png" class="h-8" alt="Avito Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white text-blue-800">Avito</span>
            </a>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse relative">
                <div class="dropdown">
                    <i id="userIcon" class="fas fa-user text-blue-500 cursor-pointer"></i>
                    <span class="text-gray-800 dark:text-white"><?php echo $username; ?></span>
                    <!-- Ajoutez le menu déroulant ici -->
                    <div id="dropdownMenu" class="dropdown-menu hidden absolute right-0 top-0 mt-8 rounded">
                        <a href="profile.php">Profile</a>
                        <a href="logout.php" class="rounded">Logout</a>
                    </div>
                </div>
            </div>

            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:border-gray-700">
                    <li>
                        <a href="announcer.php" class="block py-2 px-3 text-blue-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Home</a>
                    </li>
                    <li>
                        <a href="announces.php" class="block py-2 px-3 text-blue-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Announces</a>
                    </li>
                    <li>
                        <a href="add_announce.php" class="block py-2 px-3 text-blue-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Add announce</a>
                    </li>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var userIcon = document.getElementById("userIcon");
            var dropdownMenu = document.getElementById("dropdownMenu");

            userIcon.addEventListener("click", function() {
                // Toggle la classe 'hidden' pour afficher ou cacher le menu déroulant
                dropdownMenu.classList.toggle("hidden");
            });

            // Cacher le menu déroulant si l'utilisateur clique en dehors de celui-ci
            document.addEventListener("click", function(event) {
                if (!userIcon.contains(event.target) && !dropdownMenu.contains(event.target)) {
                    dropdownMenu.classList.add("hidden");
                }
            });
        });
    </script>

</body>

</html>