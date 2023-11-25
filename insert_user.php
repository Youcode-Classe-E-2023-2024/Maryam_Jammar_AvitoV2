<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $phone = $_POST["phone"];
    $city = $_POST["city"];

    // Assurez-vous que le mot de passe et la confirmation du mot de passe correspondent
    if ($password !== $confirm_password) {
        echo "Erreur : Les mots de passe ne correspondent pas.";
        exit();
    }

    // Exemple d'utilisation de MySQLi (assurez-vous de remplacer les informations de connexion)
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "avito";

    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Échapper les données pour éviter les attaques par injection SQL
    $username = $conn->real_escape_string($username);
    $email = $conn->real_escape_string($email);
    $password_hash = password_hash($password, PASSWORD_BCRYPT);  // Hacher le mot de passe de manière sécurisée

    // Préparer la requête SQL pour insérer l'utilisateur dans la base de données
    $sql = "INSERT INTO users (username, email, password, phone, city) VALUES ('$username', '$email', '$password_hash', '$phone', '$city')";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
        // Utilisateur ajouté avec succès, rediriger vers la page index avec un paramètre de succès
        header("Location: users.php?success=1");
        exit();
    } else {
        echo "Erreur lors de l'ajout de l'utilisateur : " . $conn->error;
    }

    // Fermer la connexion
    $conn->close();
}
?>
