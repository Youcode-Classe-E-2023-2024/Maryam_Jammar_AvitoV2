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
<?php include("navbar.php"); ?>

    <div class=" mt-4 w-full p-6 ">
       
    

<div class="w-4/6 mx-auto relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <div class="p-5 text-lg font-semibold text-gray-900 bg-white dark:text-white dark:bg-gray-800 flex justify-between ">
            Users list
            <a href="create.php" class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 text-center inline-block">
                Add user
            </a>
</div>
       
        <thead class="text-xs text-gray-700 uppercase bg-blue-200 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 mb-4">
                    Title
                </th>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Price (Dh)
                </th>
                <th scope="col" class="px-6 py-3">
                    Date of publication
                </th>
                <th scope="col" class="px-6 py-3">
                    Picture
                </th>
                <th scope="col" class="px-6 py-3">
                    Action
                </th>
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
        </div>
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
                echo "<ul class='flex pl-0 rounded list-none flex-wrap p-4'>";
                for ($i = 1; $i <= $totalPages; $i++) {
                    $active = ($i == $currentPage) ? 'bg-blue-100' : '';
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
    <?php include("footer.php"); ?>

</body>

</html>