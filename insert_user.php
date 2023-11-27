<?php
require_once 'connection.php';

// Récupérez les données du formulaire
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$role = $_POST['role'];


// Vérifiez si le mot de passe et la confirmation du mot de passe correspondent
if ($password !== $confirm_password) {
    die("Le mot de passe et la confirmation du mot de passe ne correspondent pas.");
}

// Exemple d'utilisation de MySQLi 
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
$username = $conn->real_escape_string($_POST['username']);
$email = $conn->real_escape_string($email);
$password_hash = password_hash($password, PASSWORD_BCRYPT);  // Hacher le mot de passe de manière sécurisée
$confirm_password_hash = password_hash($confirm_password, PASSWORD_BCRYPT);  // Hacher le mot de passe de manière sécurisée
$phone = $conn->real_escape_string($phone);
$city = $conn->real_escape_string($city);
$role = $conn->real_escape_string($role);


// Préparer la requête SQL pour insérer user dans la base de données
$sql = "INSERT INTO users (username, email, password, confirm_password, phone, city, role) VALUES (?, ?, ?, ?, ?, ?, ?)";

// Utiliser une requête préparée pour éviter les attaques par injection SQL
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $username, $email, $password_hash, $confirm_password_hash, $phone, $city, $role);

// Exécuter la requête
if ($stmt->execute()) {
    // User ajouté avec succès, rediriger vers la page index avec un paramètre de succès
    header("Location: users.php?success=1");
    exit();
} else {
    echo "Erreur lors de l'ajout du user : " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>
