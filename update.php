
<!-- update.php -->
<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id = $_POST["id"];
    $titre = $_POST["titre"];
    $description = $_POST["description"]; // Ajoutez les autres champs du formulaire en fonction de vos besoins
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

    // Préparer la requête SQL pour mettre à jour l'annonce dans la base de données
    $sql = "UPDATE annonces SET titre='$titre', description='$description', prix='$prix', date_publication='$date_publication', image_url='$image_url' WHERE id='$id'";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
        // Annonce mise à jour avec succès, rediriger vers la page index
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de l'annonce : " . $conn->error;
    }

    // Fermer la connexion
    $conn->close();
}
?>