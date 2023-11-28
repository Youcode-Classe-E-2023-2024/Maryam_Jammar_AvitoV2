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

    <nav class="bg-blue-100 border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="images/logo.png" class="h-8" alt="Avito Logo" />
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white text-blue-800">Avito</span>
            </a>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <i class="fas fa-user text-blue-800"></i>

            </div>
            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-user">
                <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg  md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 dark:border-gray-700">
                    <li>
                        <a href="home.php" class="block py-2 px-3 text-blue-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Home</a>
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

</body>

</html>