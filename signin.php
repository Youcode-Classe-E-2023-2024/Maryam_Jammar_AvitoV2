<?php
// connection.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "avito";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// signin.php
session_start();

if (isset($_SESSION['id_user'])) {
    // Redirect to a secure page if the user is already logged in
    header("Location: announcer.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['name'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id_user, username, password, id_role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id_user, $db_username, $db_password, $id_role);
        $stmt->fetch();

        if (password_verify($password, $db_password)) {
            $_SESSION['id_user'] = $id_user;
            $_SESSION['username'] = $db_username;
            $_SESSION['id_role'] = $id_role;

            header("Location: announcer.php");
            exit();
        } else {
            // Incorrect password
            echo "Incorrect password. Please try again.";
        }
    } else {
        // Username not found
        echo "Username not found. Please check your username or sign up for a new account.";
    }

    $stmt->close();
}

$conn->close();
?>
