<!-- delete.php -->
<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id_user"])) {
    $id_user = $_GET["id_user"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "avito";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Préparer la requête SQL pour supprimer l'user de la base de données
    $sql = "DELETE FROM users WHERE id_user='$id_user'";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
        // user supprimée avec succès, rediriger vers la page index
        header("Location: users.php");
        exit();
    } else {
        echo "Erreur lors de la suppression du user : " . $conn->error;
    }

    // Fermer la connexion
    $conn->close();
} else {
    echo "ID_user du user non spécifié ou méthode de requête incorrecte.";
    exit();
}
?>