<?php
include 'db.php';
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tableau de bord</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <header>
        <h1>Tableau de bord</h1>
    </header>
    <nav>
        <a href="index.php">Retour à l'accueil</a>
        <a href="logout.php">Déconnexion</a>
    </nav>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo $row['id']; ?>">Modifier</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>