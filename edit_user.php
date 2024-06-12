<?php
include 'db.php';
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $sql = "UPDATE users SET username='$username', email='$email' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
    } else {
        echo "Erreur : " . $conn->error;
    }
} else {
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
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
    </nav>
    <form method="post">
        <label>Nom d'utilisateur :</label><br>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username'], ENT_QUOTES); ?>" required><br>
        <label>Email :</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email'], ENT_QUOTES); ?>" required><br><br>
        <button type="submit">Modifier</button>
    </form>
</body>

</html>