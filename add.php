<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_user'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: sign_in.php');
    exit();
}

// Inclure le fichier de connexion à la base de données
include 'connection.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $prix = $_POST['prix'];
    $date_publication = $_POST['date_publication'];
    $image_url = $_POST['image_url'];

    // Récupérer l'ID de l'utilisateur connecté depuis la session
    $id_user = $_SESSION['id_user'];

    // Préparer la requête d'insertion
    $sql = "INSERT INTO annonces (titre, description, prix, date_publication, image_url, id_user) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssdssi", $titre, $description, $prix, $date_publication, $image_url, $id_user);

    // Exécuter la requête
    if ($stmt->execute()) {
        // Rediriger vers la page d'accueil ou une autre page après l'ajout réussi
        header('Location: index.php');
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'annonce : " . $stmt->error;
    }

    // Fermer la connexion et la requête
    $stmt->close();
    $conn->close();
}
?>
