<!-- add_annonce.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Modify Announce</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body">

<?php include("nav_announcer.php"); ?>

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

    <form action="update_logic.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="mx-auto m-24 w-2/6 p-6 shadow-2xl rounded-lg">
            <div class="flex justify-evenly	">
                <!-- <img src="../images/logo_form.png" alt="logo de la formulaire">  -->
                <h3 class=" text-dark-600 text-xl font-medium mb-12">Modify Annonce</h3>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="titre" id="titre" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " value="<?php echo $titre; ?>" required />
                <label for="titre" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Titre de l'annonce</label>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="text" name="description" id="description" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:gray-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " value="<?php echo $description; ?>" required />
                <label for="description" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Description</label>
            </div>
            <div class="w-full grid md:grid-cols-2 md:gap-6">
                <div class="relative z-0 w-full mb-6 group">
                    <input type="number" name="prix" id="prix" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " value="<?php echo $prix; ?>" required />
                    <label for="prix" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Prix (en Dirham)</label>
                </div>
                <div class="relative z-0 w-full mb-6 group">
                    <input type="text" name="date_publication" id="date_publication" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " value="<?php echo date("Y-m-d H:i:s"); ?>" readonly />
                    <label for="date_publication" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Date de publication</label>
                </div>
            </div>
            <div class="relative z-0 w-full mb-6 group">
                <input type="url" name="image_url" id="image_url" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:gray-gray-600 dark:focus:border-gray-500 focus:outline-none focus:ring-0 focus:border-gray-600 peer" placeholder=" " value="<?php echo $image_url; ?>" required />
                <label for="image_url" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-gray-600 peer-focus:dark:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Image (url)</label>
            </div>

            <div class="flex justify-between">
            <a href="announces.php" class="text-white bg-blue-600 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2 text-center inline-block">
                Back
            </a>
                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

            </div>

        </div>

    </form>
    <?php include("footer_announcer.php"); ?>

</body>

</html>