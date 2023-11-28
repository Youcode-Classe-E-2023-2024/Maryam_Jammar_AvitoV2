<?php
require_once 'connection.php';

// Récupérez les données du formulaire
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$phone = $_POST['phone'];
$city = $_POST['city'];
// $id_role = $_POST['id_role'];

// Vérifiez si le mot de passe et la confirmation du mot de passe correspondent
if ($password !== $confirm_password) {
    die("Le mot de passe et la confirmation du mot de passe ne correspondent pas.");
}

// Échapper les données pour éviter les attaques par injection SQL
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($_POST['email']);
$phone = $conn->real_escape_string($_POST['phone']);
$city = $conn->real_escape_string($_POST['city']);
// $id_role = $conn->real_escape_string($_POST['id_role']);

// Hacher le mot de passe de manière sécurisée
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Préparer la requête SQL pour insérer l'utilisateur dans la base de données
$sql = "INSERT INTO users (username, email, password, phone, city) VALUES (?, ?, ?, ?, ?)";

// Utiliser une requête préparée pour éviter les attaques par injection SQL
$stmt = $conn->prepare($sql);

// Vérifier si la préparation de la requête a réussi
if (!$stmt) {
    die("Erreur de préparation de la requête : " . $conn->error);
}

// Liaison des paramètres
$stmt->bind_param("sssss", $username, $email, $password_hash, $phone, $city);

// Vérifier si la liaison des paramètres a réussi
if (!$stmt->execute()) {
    die("Erreur lors de l'exécution de la requête : " . $stmt->error);
}

// Vérifier le nombre de lignes affectées (doit être 1 si l'insertion a réussi)
if ($stmt->affected_rows === 1) {
    // User ajouté avec succès, rediriger vers la page index avec un paramètre de succès
    header("Location: users.php?success=1");
    exit();
} else {
    echo "Erreur lors de l'ajout de l'utilisateur : Aucune ligne n'a été insérée.";
}

// Fermer la requête
$stmt->close();


// Fermer la connexion
$stmt->close();
$conn->close();
?>
