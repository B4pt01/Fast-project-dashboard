<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['userid'] = $user['id'];
            $_SESSION['is_admin'] = $user['is_admin']; // Ajouter le statut admin à la session
            header("Location: " . ($user['is_admin'] ? "dashboard.php" : "account.php"));
        } else {
            echo "<div class='message'>Mot de passe incorrect.</div>";
        }
    } else {
        echo "<div class='message'>Utilisateur non trouvé.</div>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <header>
        <h1>Se connecter</h1>
    </header>
    <nav>
        <a href="index.php">Retour à l'accueil</a>
    </nav>
    <form method="post">
        <label>Nom d'utilisateur :</label><br>
        <input type="text" name="username" required><br>
        <label>Mot de passe :</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Se connecter</button>
    </form>
</body>

</html>