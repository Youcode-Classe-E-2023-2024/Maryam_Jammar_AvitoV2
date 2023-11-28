<?php
// add.php

// Inclure le fichier de connexion à la base de données
require_once 'connection.php';

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_user'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    header("Location: sign_in.php");
    exit();
}

// Récupérer les données du formulaire
$titre = $_POST['titre'];
$description = $_POST['description'];
$prix = $_POST['prix'];
$date_publication = $_POST['date_publication'];
$image_url = $_POST['image_url'];

// Récupérer l'ID de l'utilisateur connecté
$id_user = $_SESSION['id_user'];

// Requête d'insertion dans la table des annonces
$sql = "INSERT INTO annonces (id_user, titre, description, prix, date_publication, image_url) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isdsss", $id_user, $titre, $description, $prix, $date_publication, $image_url);

// Exécuter la requête d'insertion
if ($stmt->execute()) {
    // Rediriger vers la page d'accueil ou une autre page après l'insertion
    header("Location: announces.php");
    exit();
} else {
    // Gérer les erreurs d'insertion
    echo "Erreur lors de l'insertion : " . $stmt->error;
}

// Fermer la connexion et la déclaration
$stmt->close();
$conn->close();
?>
