<?php
include 'db.php';
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$current_user_id = $_SESSION['userid'];
$is_admin = $_SESSION['is_admin']; // Récupérer le statut admin de l'utilisateur connecté

// Si l'utilisateur n'est pas admin et essaie de modifier un autre utilisateur, rediriger vers account.php
if (!$is_admin && $current_user_id != $id) {
    header("Location: account.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0; // Vérifier si la case admin est cochée

    $sql = "UPDATE users SET username='$username', email='$email', is_admin=$is_admin WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Erreur : " . $conn->error;
    }
} else {
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        echo "<div class='message'>Erreur : Utilisateur non trouvé.</div>";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Modifier utilisateur</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <header>
        <h1>Modifier utilisateur</h1>
    </header>
    <nav>
        <a href="index.php">Retour à l'accueil</a>
        <a href="logout.php">Déconnexion</a>
    </nav>
    <?php if (isset($user)) : ?>
        <form method="post">
            <label>Nom d'utilisateur :</label><br>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['username'], ENT_QUOTES); ?>" required><br>
            <label>Email :</label><br>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'], ENT_QUOTES); ?>" required><br>
            <?php if ($_SESSION['is_admin']) : ?> <!-- Afficher l'option admin seulement pour les administrateurs -->
                <label>Administrateur :</label><br>
                <input type="checkbox" name="is_admin" <?php echo $user['is_admin'] ? 'checked' : ''; ?>><br><br>
            <?php endif; ?>
            <button type="submit">Modifier</button>
        </form>
    <?php else : ?>
        <div class='message'>Erreur : Impossible de charger les informations de l'utilisateur.</div>
    <?php endif; ?>
</body>

</html>