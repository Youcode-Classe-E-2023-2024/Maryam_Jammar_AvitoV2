<?php
include 'connection.php';

session_start();

if (isset($_POST['submit'])) {
    // Assurez-vous que ces variables sont correctement définies
    $dbname = "avito";
    $users = "users";

    $conn->select_db($dbname);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $CheckPass = $_POST['password'];

    // Fetch le mot de passe haché depuis la base de données basé sur l'e-mail fourni
    $select = "SELECT * FROM $users WHERE email = '$email'";
    $result = mysqli_query($conn, $select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        // Utilisez password_verify pour vérifier si le mot de passe entré est correct
        if (password_verify($CheckPass, $row['password'])) {

            if ($row['role'] == 'Admin') {
                $_SESSION['role'] = $row['role'];
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['phone'] = $row['phone'];
                header('location: home.php');
            } elseif ($row['role'] == 'Announcer') {
                $_SESSION['id_user'] = $row['id_user'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['phone'] = $row['phone'];
                header('location: announcer.php');
            } else {
                echo 'Unknown role!';
                // Redirection vers une page d'erreur ou une autre logique
            }
        } else {
            echo 'Incorrect email or password!';
            header('location: sign_up.php'); 
        }
    } else {
        echo 'Incorrect email or password!';
        header('location: sign_up.php'); 
    }
}
$conn->close();
?>
