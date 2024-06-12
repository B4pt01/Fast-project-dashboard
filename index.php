<?php
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <header>
        <h1>Bienvenue sur notre site</h1>
    </header>
    <nav>
        <a href="register.php">Inscription</a>
        <?php if (!isset($_SESSION['userid'])) : ?>
            <a href="login.php">Connexion</a>
        <?php endif; ?>
        <?php if (isset($_SESSION['userid'])) : ?>
            <a href="dashboard.php">Mon compte</a>
        <?php endif; ?>
    </nav>
    <main>
        <section>
            <h2>À propos de notre site</h2>
            <p>
                Notre site permet aux utilisateurs de s'inscrire, de se connecter, et de gérer leurs informations de compte.
                Vous pouvez voir et modifier les informations de votre profil ainsi que consulter la liste des autres utilisateurs.
            </p>
        </section>
        <section>
            <h2>Fonctionnalités principales</h2>
            <ul>
                <li>Inscription d'un nouvel utilisateur</li>
                <li>Connexion sécurisée</li>
                <li>Tableau de bord utilisateur</li>
                <li>Modification des informations de profil</li>
            </ul>
        </section>
        <section>
            <h2>Commencez dès maintenant</h2>
            <p>
                Si vous n'avez pas encore de compte, vous pouvez <a href="register.php">vous inscrire ici</a>.
                <?php if (!isset($_SESSION['userid'])) : ?>
                    Si vous avez déjà un compte, <a href="login.php">connectez-vous ici</a>.
                <?php endif; ?>
            </p>
        </section>
    </main>
</body>

</html>