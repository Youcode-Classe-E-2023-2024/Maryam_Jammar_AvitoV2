<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>

<body>
<?php include("navbar.php"); ?>

    <div class="flex justify-center items-center m-36">
        <a class="block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">

            <h5 class="mb-2 text-blue-700 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Welcome admin!</h5>
            <p class="text-blue-400">Vous avez accédé au tableau de bord administrateur. <br> À partir d'ici, vous pouvez gérer les annonces, superviser les utilisateurs et accéder à des fonctionnalités avancées pour maintenir le site en bon état.
            <br> Bonne journée!</p>
        </a>
    </div>

    <?php include("footer.php"); ?>
</body>

</html>