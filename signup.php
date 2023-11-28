<?php
// connection.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avito";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// signup.php
require_once 'connection.php';

// Démarrer la session
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['id_user'])) {
    // L'utilisateur est déjà connecté, rediriger vers une page sécurisée
    header("Location: sign_in.php");
    exit();
}

// Récupérer les données du formulaire
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$phone = $_POST['phone'];
$city = $_POST['city'];
// Ajouter cette ligne pour récupérer le rôle
$role = "Announcer"; // Vous pouvez ajuster cela en fonction de votre logique

// Vérifier si le mot de passe et la confirmation du mot de passe correspondent
if ($password !== $confirm_password) {
    die("Le mot de passe et la confirmation du mot de passe ne correspondent pas.");
}

// Hasher le mot de passe
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Insérer l'utilisateur dans la base de données
$sql = "INSERT INTO users (username, email, password, phone, city, role) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $username, $email, $password_hash, $phone, $city, $role);

if ($stmt->execute()) {
    // Récupérer l'ID du nouvel utilisateur inséré
    $nouvellement_inseré_id = $conn->insert_id;

    // Enregistrer les informations de l'utilisateur dans la session
    $_SESSION['id_user'] = $nouvellement_inseré_id;
    $_SESSION['username'] = $username;
    $_SESSION['role'] = $role;

    // Rediriger vers une page sécurisée
    header("Location: sign_in.php");
    exit();
} else {
    echo "Erreur lors de l'inscription : " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>
