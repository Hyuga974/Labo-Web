<?php

include 'pokemon.php';
include 'pokeball.php';

$pokemon = new Pokemon("Arcko", 100, 2, "Plante", 3);
$ennemy = new Pokemon("Salamche", 100, 4, "Feu", 6);
$pokeball = new Pokeball("honor", 30);

$pokemon->attack($ennemy);
echo "----------------";
$ennemy->attack($pokemon);
echo "----------------";
$pokemon->attack($ennemy);
echo "----------------";
$ennemy->attack($pokemon);
echo "----------------";

$pokeball->capture($pokemon1);