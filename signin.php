<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Connexion à la base de données
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $db_name = "avito";

    $conn = new mysqli($servername, $db_username, $db_password, $db_name);

    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Requête SQL pour vérifier l'utilisateur dans la base de données
    $stmt = $conn->prepare("SELECT id_user, username, email, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_user, $db_username, $db_password_hash);
        $stmt->fetch();

        // Vérifier le mot de passe haché
        if (password_verify($password, $db_password_hash)) {
            // Mot de passe correct, connectez l'utilisateur
            $_SESSION["id_user"] = $id_user;
            $_SESSION["username"] = $db_username;

            // Rediriger vers la page d'accueil ou une autre page appropriée
            header("Location: home.php");
            exit();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }

    $stmt->close();
    $conn->close();
}
?>
