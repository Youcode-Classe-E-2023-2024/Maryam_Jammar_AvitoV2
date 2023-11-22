<!-- delete.php -->
<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
    $id = $_GET["id"];

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

    // Préparer la requête SQL pour supprimer l'annonce de la base de données
    $sql = "DELETE FROM annonces WHERE id='$id'";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
        // Annonce supprimée avec succès, rediriger vers la page index
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la suppression de l'annonce : " . $conn->error;
    }

    // Fermer la connexion
    $conn->close();
} else {
    echo "ID de l'annonce non spécifié ou méthode de requête incorrecte.";
    exit();
}
?>
