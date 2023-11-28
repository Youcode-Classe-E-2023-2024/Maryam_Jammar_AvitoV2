<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>

    <style>
        /* Add your custom styles here */
        footer {
            background: rgb(238, 174, 202);
            background: radial-gradient(circle, rgba(238, 174, 202, 1) 0%, rgba(163, 148, 233, 1) 100%);
        }
    </style>

    <footer class="mx-0 mb-0 p-0 bg-blue-100 shadow dark:bg-gray-900 m-4">
        <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
            <div class="sm:flex sm:items-center sm:justify-between">
                <a href="announces.php" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
                    <img src="images/logo.png" class="h-8" alt="Flowbite Logo" />
                    <span class="text-gray-700 self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Avito</span>
                </a>
                <ul class="flex flex-wrap items-center space-x-6 mb-6 text-sm font-medium text-gray-500 sm:mb-0 dark:text-gray-400">
                    <li>
                        <a href="announcer.php" class="text-gray-700 hover:underline me-4 md:me-6">Home</a>
                    </li>
                    <li>
                        <a href="index.php" class="text-gray-700 hover:underline me-4 md:me-6">Announces</a>
                    </li>

                </ul>
            </div>
            <!-- <hr class="my-6 border-gray-300 sm:mx-auto dark:border-gray-700 lg:my-8" /> -->
            <span class="block text-sm text-gray-700 sm:text-center dark:text-gray-400">© 2023 <a href="https://flowbite.com/" class="hover:underline">Avito</a>. All Rights Reserved.</span>
        </div>
    </footer>


</body>

</html>