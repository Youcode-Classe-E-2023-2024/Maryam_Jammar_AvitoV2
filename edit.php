<!-- edit_annonce.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modifier une Annonce</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
<?php include("navbar.php"); ?>

    <?php
    require_once 'connection.php';

    // Vérifier si l'ID de l'annonce est passé en paramètre dans l'URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Exemple d'utilisation de MySQLi (assurez-vous de remplacer les informations de connexion)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "avito";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        // Préparer la requête SQL pour sélectionner l'annonce avec l'ID spécifié
        $sql = "SELECT * FROM annonces WHERE id='$id'";
        $result = $conn->query($sql);

        // Vérifier si la requête a réussi
        if ($result === FALSE) {
            echo "Erreur lors de la récupération de l'annonce : " . $conn->error;
        } else {
            // Vérifier si l'annonce existe
            if ($result->num_rows > 0) {
                // Récupérer les données de l'annonce
                $row = $result->fetch_assoc();
                $titre = $row["titre"];
                $description = $row["description"];
                $prix = $row["prix"];
                $date_publication = $row["date_publication"];
                $image_url = $row["image_url"];
            } else {
                echo "Aucune annonce trouvée avec l'ID spécifié.";
                exit();
            }

            // Libérer le résultat
            $result->free();
        }

        // Fermer la connexion
        $conn->close();
    } else {
        echo "ID de l'annonce non spécifié.";
        exit();
    }
    ?>

    <form action="update.php" method="POST">
        <!-- Ajouter un champ caché pour stocker l'ID de l'annonce -->
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="ml-96 mt-48 w-3/6 border-2 border-orange-700 p-6">
            <!-- Afficher les valeurs actuelles de l'annonce dans les champs -->
            <div class="flex justify-evenly">
                <h3 class="text-dark-600 text-xl font-medium">Modifier Annonce</h3>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="titre" id="titre" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " value="<?php echo $titre; ?>" required />
                <label for="titre" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Titre de l'annonce</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:gray-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " value="<?php echo $description; ?>" required />
                <label for="description" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="number" name="prix" id="prix" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:gray-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " value="<?php echo $prix; ?>" required />
                <label for="prix" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Prix</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="date" name="date_publication" id="date_publication" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " value="<?php echo $date_publication; ?>" required />
                <label for="date_publication" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Date de publication</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="url" name="image_url" id="image_url" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " value="<?php echo $image_url; ?>" required />
                <label for="image_url" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">URL de l'image</label>
            </div>

            <button type="submit" class="text-white bg-orange-700 hover:bg-orange-800 focus:ring-4 focus:outline-none focus:ring-orange-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-800">Modifier</button>
        </div>
    </form>
    <?php include("navbar.php"); ?>

</body>

</html>