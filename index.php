<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.tailwindcss.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"> <!-- Font Awesome CSS -->
    <title>Liste des Annonces</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body >
<style>
        .background-image {
            width: 100%;
            height: 600px;
            background-image: url('images/bg2.jpg');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }
    </style>

    <div class=" mt-4 w-full p-6 ">
        <div class="flex justify-around items-center p-4">
            <!-- <h3 class="text-dark-600 text-xl font-medium">Liste des Annonces</h3> -->
            <a href="create.php" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 text-center inline-block">
                Ajouter Annonce
            </a>
            
            <form class="flex items-center w-96  space-x-1">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    
                    <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search branch name..." required>
                </div>
                <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search</span>
                </button>
            </form>
        </div>


        <div class="relative overflow-x-auto ">
            <table class="w-4/6 mx-auto text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">Titre</th>
                        <th scope="col" class="px-6 py-3">Description</th>
                        <th scope="col" class="px-6 py-3">Prix</th>
                        <th scope="col" class="px-6 py-3">Date de publication</th>
                        <th scope="col" class="px-6 py-3">Image</th>
                        <th scope="col" class="px-6 py-3 rounded-tr-lg">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white">

                    <?php
                    require_once 'connection.php';

                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "avito";

                    $conn = new mysqli($servername, $username, $password, $dbname);

                    if ($conn->connect_error) {
                        die("La connexion a échoué : " . $conn->connect_error);
                    }

                    $resultPerPage = 6; // Nombre d'annonces par page
                    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                    $startFrom = ($currentPage - 1) * $resultPerPage;

                    $sql = "SELECT * FROM annonces LIMIT $startFrom, $resultPerPage";
                    $result = $conn->query($sql);

                    if ($result === FALSE) {
                        echo "Erreur lors de la récupération des annonces : " . $conn->error;
                    } else {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='p-2'>" . $row["titre"] . "</td>";
                            echo "<td class='p-2'>" . $row["description"] . "</td>";
                            echo "<td class='p-2'>" . $row["prix"] . " Dirhams</td>";
                            echo "<td class='p-2'>" . $row["date_publication"] . "</td>";
                            echo "<td class='p-2'><img src='" . $row["image_url"] . "' alt='Image de l'annonce' class='w-16 h-16'></td>";
                            echo "<td class='p-2 space-x-6'>
                                    <a href='edit.php?id=" . $row["id"] . "' class='ml-4 text-blue-500 hover:text-blue-700'>
                                        <i class='fas fa-edit'></i> 
                                    </a> 
                                    <a href='delete.php?id=" . $row["id"] . "' class='text-red-600 hover:text-red-800' onclick='return confirm(\"Voulez-vous vraiment supprimer cette annonce ?\")'>
                                        <i class='fas fa-trash'></i> 
                                    </a>
                                </td>";
                            echo "</tr>";
                        }

                        $result->free();
                        // $conn->close();
                    }

                    ?>

                </tbody>
            </table>
            <div class="mt-4 flex justify-center items-center ">
                <?php
                $sqlCount = "SELECT COUNT(*) AS total FROM annonces";
                $resultCount = $conn->query($sqlCount);
                $row = $resultCount->fetch_assoc();
                $totalRecords = $row['total'];
                $totalPages = ceil($totalRecords / $resultPerPage);

                // Check if there's more than one page
                if ($totalPages > 1) {
                    echo "<nav class='block '>";
                    echo "<ul class='flex pl-0 rounded list-none flex-wrap '>";
                    for ($i = 1; $i <= $totalPages; $i++) {
                        $active = ($i == $currentPage) ? 'bg-gray-200' : '';
                        echo "<li class='relative block py-2 px-3 ml-2 bg-white leading-tight border {$active}'>";
                        echo "<a href='?page={$i}' class='page-link'>{$i}</a>";
                        echo "</li>";
                    }
                    echo "</ul>";
                    echo "</nav>";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
</body>

</html>