<?php require_once 'checkConnection.php'?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Météo - Bordeaux</title>
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
        <H1>
            <?php echo nl2br("Hello World \n");?>
        </H1>
        
        <h2>
        <?php
            date_default_timezone_set('Europe/Paris');
            echo date('l jS \of F Y h:i:s A').PHP_EOL;
        ?>
        </h2>

        <div>
            <a href="/">Accueil</a>
            <a href="./paris.php">Pas OUf</a>
        </div>

    <?php
    $i = 0;
    while ($i <= 4) {
        ?>
        <h4>
            <?php if (0 === $i) { ?>
                Aujourd'hui
            <?php } else { ?>
                A J+<?= $i; ?>
            <?php } ?>
        </h4>
        <div>
            <img src="https://www.prevision-meteo.ch/uploads/widget/bordeaux_<?= $i; ?>.png" alt="Météo bordeaux à j+<?= $i; ?>">
        </div>
        <?php
        $i++;
    }
    ?>
</body>
</html>