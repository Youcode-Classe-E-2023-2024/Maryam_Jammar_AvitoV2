<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure votre fichier de configuration de la base de données
    include('connection.php');

    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $city = $_POST['city'];

    // Hasher le mot de passe avant de le stocker dans la base de données
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Préparer et exécuter la requête SQL
    $sql = "INSERT INTO users (name, email, password, confirm_password, phone, city) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    // Vérifier si la préparation de la requête a réussi
    if ($stmt) {
        // Lier les paramètres
        $stmt->bind_param("sssss", $name, $email, $hashedPassword, $confirm_password, $phone, $city);

        // Exécuter la requête
        if ($stmt->execute()) {
            // Rediriger l'utilisateur vers la page de connexion après l'inscription réussie
            header("Location: sign_in.php");
            exit();
        } else {
            echo "Erreur d'exécution de la requête : " . $stmt->error;
        }

        // Fermer la déclaration préparée
        $stmt->close();
    } else {
        echo "Erreur de préparation de la requête : " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
}
?>
