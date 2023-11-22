<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];
    $date_publication = $_POST["date_publication"];
    $image_url = $_POST["image_url"];

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

    // Échapper les données pour éviter les attaques par injection SQL
    $titre = $conn->real_escape_string($titre);
    $description = $conn->real_escape_string($description);
    $date_publication = $conn->real_escape_string($date_publication);
    $image_url = $conn->real_escape_string($image_url);

    // Préparer la requête SQL pour insérer l'annonce dans la base de données
    $sql = "INSERT INTO annonces (titre, description, prix, date_publication, image_url) VALUES ('$titre', '$description', $prix, '$date_publication', '$image_url')";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
        // Annonce ajoutée avec succès, rediriger vers la page index avec un paramètre de succès
        header("Location: index.php?success=1");
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'annonce : " . $conn->error;
    }

    // Fermer la connexion
    $conn->close();
}
