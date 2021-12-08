<?php 

$dsn = "mysql:host=localhost:3306;dbname=pokedex";
$username = "root";
$password = "";

try{
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e){
    echo $e->getMessage();
    die();
}

?>

<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pokedex</title>
    <link rel="stylesheet" href="./stylesheet.css">
</head>
<body>
    <h1>Mon Pokemon</h1>

    <?php 
        $query = "SELECT * FROM pokemon";

        $results = $pdo->prepare($query);
        $results->execute();

        $pokemons=$results->fetchAll(mode:PDO::FETCH_ASSOC);

        foreach ($pokemons as $pokemon){ ?>
            <p>Je suis  <?=$pokemon['nom'] ?> et mon type est : <?= $pokemon['type'] ?>
            <?php if ($pokemon['capturer']){ ?>
                ==> Possédé </p>
            <?php } ?>
        <?php } ?>

    <hr />


    <h2>Ajoute des pokémons!</h2>
    
    <form  action="index.php" method="post" name="pokeform">
        <label for="">
            Nom du Pokemon
            <input type="text" name="name">
        </label>
        
        <br><br>

        <label for="">
            Type du Pokemon
            <input type="text" name="type">
        </label>
        
        <br><br>

        <label for="">
            Puissance
            <input type="number" name="power">
        </label>
        
        <br><br>

        <label for="">
            Possédez-vous ce pokémon?
            <input type="checkbox" name="capture">
        </label>

        <button type="submit" href="http://localhost:8080/index.php">Créer</button>
        </form>

        

    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){ 
            $name = $_POST['name'];
            $type = $_POST['type'];
            $power = $_POST['power'];

            $capture= $_POST['capture'] ?? 0;
            ?>
            <br>
            <p>Vous avez ajouté <?=$name?>. Ce pokemon est de type <?=$type?> et à une force de type <?=$power?>.</p>
            <?php if ($capture) { ?>
                <p>
                    Ah et vous possédez ce pokémon, félicitation!
                </p>
            <?php } else { ?>
                <p>
                    Vous ne l'avez pas encore capturé, pas de soucis vous allez y arriver!
                </p>
        <?php } }

        $queryString = "INSERT INTO pokemon (nom, type, puissance, capturer) VALUES (:name, :type, :power, :capture)";
        
        $data = [
            'name' => $name,
            'type' => $type,
            'power' => $power,
            'capture' => (bool) $capture,
        ];

        $query = $pdo->prepare($queryString);
        $query->execute($data);
    ?>
</body>
</html>