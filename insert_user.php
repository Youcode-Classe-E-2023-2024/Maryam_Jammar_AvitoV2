<?php
require_once 'connection.php';

// Récupérez les données du formulaire
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$id_role = $_POST['id_role'];

// Vérifiez si le mot de passe et la confirmation du mot de passe correspondent
if ($password !== $confirm_password) {
    die("Le mot de passe et la confirmation du mot de passe ne correspondent pas.");
}

// Échapper les données pour éviter les attaques par injection SQL
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);
$city = $conn->real_escape_string($_POST['city']);
$id_role = $conn->real_escape_string($_POST['id_role']);

// Hacher le mot de passe de manière sécurisée
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Préparer la requête SQL pour insérer l'utilisateur dans la base de données
$sql = "INSERT INTO users (username, email, password, phone, city, id_role) VALUES (?, ?, ?, ?, ?, ?)";

// Utiliser une requête préparée pour éviter les attaques par injection SQL
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $username, $email, $password_hash, $phone, $city, $id_role);

// Exécuter la requête
if ($stmt->execute()) {
    // User ajouté avec succès, rediriger vers la page index avec un paramètre de succès
    header("Location: users.php?success=1");
    exit();
} else {
    echo "Erreur lors de l'ajout de l'utilisateur : " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>
