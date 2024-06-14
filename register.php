<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $email = $_POST['email'];
    $is_admin = 0; // Tous les utilisateurs enregistrés par défaut ne sont pas admin

    $sql = "INSERT INTO users (username, password, email, is_admin) VALUES ('$username', '$password', '$email', $is_admin)";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='message'>Inscription réussie. <a href='login.php'>Connectez-vous</a></div>";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <header>
        <h1>S'inscrire</h1>
    </header>
    <nav>
        <a href="index.php">Retour à l'accueil</a>
    </nav>
    <form method="post">
        <label>Nom d'utilisateur :</label><br>
        <input type="text" name="username" required><br>
        <label>Mot de passe :</label><br>
        <input type="password" name="password" required><br>
        <label>Email :</label><br>
        <input type="email" name="email" required><br><br>
        <button type="submit">S'inscrire</button>
    </form>
</body>

</html>