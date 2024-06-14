<?php
include 'db.php';
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['userid'];

$sql = "SELECT * FROM users WHERE id=$id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "<div class='message'>Erreur : Utilisateur non trouvé.</div>";
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Mon compte</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <header>
        <h1>Mon compte</h1>
    </header>
    <nav>
        <a href="index.php">Retour à l'accueil</a>
        <a href="logout.php">Déconnexion</a>
    </nav>
    <section>
        <h2>Informations de l'utilisateur</h2>
        <p><strong>Nom d'utilisateur :</strong> <?php echo htmlspecialchars($user['username'], ENT_QUOTES); ?></p>
        <p><strong>Email :</strong> <?php echo htmlspecialchars($user['email'], ENT_QUOTES); ?></p>
    </section>
</body>

</html>