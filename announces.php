<?php
session_start();
?>

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

<body>
    <?php include("nav_announcer.php"); ?>
    <a href="add_announce.php" class="animate-bounce fixed left-0 mt-4 text-white bg-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 text-center inline-block">
        Add announce
    </a>

    <div class="mt-12 w-full p-6 ">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
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

            if (isset($_SESSION['id_user'])) {
                $id_user = $_SESSION['id_user'];

                $resultPerPage = 6; // Nombre d'annonces par page
                $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
                $startFrom = ($currentPage - 1) * $resultPerPage;

                $sql = "SELECT annonces.*, users.username 
                        FROM annonces
                        JOIN users ON annonces.id_user = users.id_user
                        WHERE annonces.id_user = $id_user
                        LIMIT $startFrom, $resultPerPage";

                $result = $conn->query($sql);

                if ($result === FALSE) {
                    echo "Erreur lors de la récupération des annonces : " . $conn->error;
                } else {
                    while ($row = $result->fetch_assoc()) {
            ?>
                        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="p-8 rounded-t-lg" src="<?php echo $row["image_url"]; ?>" alt="product image" />
                            </a>
                            <div class="px-5 pb-5">
                                <a href="#">
                                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white"><?php echo $row["titre"]; ?></h5>
                                </a>
                                <div class="flex items-center justify-between mt-2.5 mb-5">
                                    <p><?php echo $row["description"]; ?></p>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white"><?php echo $row["prix"]; ?> Dh</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <p class="text-blue-800 ">Added by: <?php echo $row["username"]; ?></p>
                                    <div class="flex space-x-2">
                                        <!-- Bouton Update -->
                                        <a href='update_announce.php?id=<?php echo $row["id"]; ?>' class='text-blue-500 hover:text-blue-700'>
                                            <button class="px-3 py-1 bg-green-600 text-white rounded">Update</button>
                                        </a>
                                        <!-- Bouton Delete -->
                                        <a href='delete.php?id=<?php echo $row["id"]; ?>' class='text-red-600 hover:text-red-800' onclick='return confirm("Voulez-vous vraiment supprimer cette annonce ?")'>
                                            <button class="px-3 py-1 bg-gray-600 text-white rounded">Delete</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
            <?php
                    }
                    $result->free();
                }
            }
            // $conn->close();
            ?>
        </div>
    </div>

    <?php include("footer_announcer.php"); ?>
</body>

</html>