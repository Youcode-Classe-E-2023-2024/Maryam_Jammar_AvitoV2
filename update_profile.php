<?php
require_once 'connection.php';

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id_user = $_POST["id_user"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    // $password = $_POST["password"];
    // $confirm_password = $_POST["confirm_password"];
    $phone = $_POST["phone"];
    $city = $_POST["city"];
    $role = $_POST["role"];


    // Vérifier si le mot de passe a été modifié
    if (!empty($password)) {
        // Hacher le nouveau mot de passe
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    } else {
        // Si le mot de passe n'a pas été modifié, récupérer le mot de passe existant depuis la base de données
        $existing_password_sql = "SELECT password FROM users WHERE id_user='$id_user'";
        $result = $conn->query($existing_password_sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashed_password = $row["password"];
        } else {
            die("Utilisateur non trouvé.");
        }
    }

    // Préparer la requête SQL pour mettre à jour l'utilisateur dans la base de données
    $sql = "UPDATE users SET username='$username', email='$email', phone='$phone', city='$city', role='$role' WHERE id_user='$id_user'";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
        // Utilisateur mis à jour avec succès, rediriger vers la page index
        header("Location: home.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de l'utilisateur : " . $conn->error;
    }
}

// Fermer la connexion en dehors de la condition POST
$conn->close();
?>
