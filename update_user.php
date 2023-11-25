
<!-- update.php -->
<?php
require_once 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $id_user = $_POST["id_user"];
    $username = $_POST["username"];
    $email = $_POST["email"]; // Ajoutez les autres champs du formulaire en fonction de vos besoins
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $phone = $_POST["phone"];
    $city = $_POST["city"];

    // Exemple d'utilisation de MySQLi (assurez-vous de remplacer les informations de connexion)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "avito";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué : " . $conn->connect_error);
    }

    // Préparer la requête SQL pour mettre à jour l'user dans la base de données
    $sql = "UPDATE users SET username='$username', email='$email', password='$password', confirm_password='$confirm_password', phone='$phone', city='$city' WHERE id_user='$id_user'";

    // Exécuter la requête
    if ($conn->query($sql) === TRUE) {
        // user mise à jour avec succès, rediriger vers la page index
        header("Location: users.php");
        exit();
    } else {
        echo "Erreur lors de la mise à jour de l'user : " . $conn->error;
    }

    // Fermer la connexion
    $conn->close();
}
?>