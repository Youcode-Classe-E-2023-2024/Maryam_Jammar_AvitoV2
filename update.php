<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id = $_POST["id"];
    $titre = $_POST["titre"];
    $description = $_POST["description"];
    $prix = $_POST["prix"];
    $date_publication = $_POST["date_publication"];
    $image_url = $_POST["image_url"];

    // Connexion à la base de données
    $conn = new mysqli("localhost", "root", "", "avito");

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Préparer la requête SQL avec des déclarations paramétrées
    $sql = "UPDATE annonces SET titre=?, description=?, prix=?, date_publication=?, image_url=? WHERE id=?";

    // Préparer la déclaration
    $stmt = $conn->prepare($sql);

    // Vérifier si la préparation a échoué
    if ($stmt === FALSE) {
        die("Erreur lors de la préparation de la requête : " . $conn->error);
    }

    // Binder les paramètres
    $stmt->bind_param("ssdssi", $titre, $description, $prix, $date_publication, $image_url, $id);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Annonce mise à jour avec succès, rediriger vers la page index
        header("Location: index.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de l'annonce : " . $stmt->error;
    }

    // Fermer la déclaration et la connexion
    $stmt->close();
    $conn->close();
}
?>
