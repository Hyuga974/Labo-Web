<?php session_start(); ?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Météo - Accueil</title>
    <?php
        $now = (new DateTime())->format('H');
        if ($now >= 7 && $now <= 19) {
    ?>
        <link rel="stylesheet" href="./light.css">
    <?php } else { ?>
        <link rel="stylesheet" href="./dark.css">
    <?php } ?>
</head>
<body>
    <div>
        <?php
            if (
                    isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])
                    && $_POST['username'] === "toto@gmail.com" && $_POST['password'] === "password"
            ) {
                $_SESSION['username'] = htmlspecialchars($_POST['username']);
                $_SESSION['connected'] = true;
            }
        ?>
    </div>

    <?php if (!isset($_SESSION['connected']) || !$_SESSION['connected']) { ?>
        <h2>Formulaire de connexion</h2>
        <div>
            <form method="post">
                <label for="username">
                    Nom d'utilisateur :
                    <input type="text" name="username" placeholder="toto@gmail.com" required autofocus>
                </label>
                <br />
                <label for="password">
                    Mot de passe :
                    <input type="password" name="password" placeholder="password" required>
                </label>
                <br />
                <button type="submit" name="login">Connexion</button>
            </form>
        </div>
    <?php } else { ?>
        <h1>Vous êtes connecté ! Bonjour <strong><?= $_SESSION['username'] ?></strong> !</h1>
        <a href="/logout.php">Se déconnecter</a>
        <h3>Quelle météo voulez-vous voir ?</h3>
        <div>
            <ul>
                <li><a href="/paris.php">Paris</a></li>
                <li><a href="/bordeaux.php">Bordeaux</a></li>
            </ul>
        </div>
    <?php } ?>
</body>
</html>