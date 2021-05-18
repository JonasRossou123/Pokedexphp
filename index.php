<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Pokedexphp</title>
</head>
<body>

<?php
//Code won't run until something's filled in
if (isset($_POST['pokemon'])) {

//pokemon added at the end of the link
    $api = 'https://pokeapi.co/api/v2/pokemon/' . $_POST['pokemon'];
//link to the Pokémon it has evolved from
    $apiEvolution = 'https://pokeapi.co/api/v2/pokemon-species/' . $_POST['pokemon'];

//file_get_contents -> Reads entire file into a string
    $apistring = file_get_contents($api, true);
//idem other link
    $apiEvolutionstring = file_get_contents($apiEvolution, true);
//Takes a JSON encoded string and converts (=decode) it into a PHP variable.
    $pokemonData = json_decode($apistring, true);
//idem other link
    $pokemonEvolution = json_decode($apiEvolutionstring, true);

    $pokemon_name = $pokemonData['name'];
    $pokemon_id = $pokemonData['id'];
    $pokemon_image = $pokemonData['sprites']['front_default'];
    $pokemon_evolved = $pokemonEvolution['evolves_from_species']['name'];
} ?>

<p>WIE IS DEZE POKEMON?</p>
<form class="search-poke" action="" method="POST">
    <input type="text" name="pokemon" placeholder="Enter Pokémon or ID">
    <input type="submit" name="submit" value="Search">
</form>

<?php echo $pokemon_name ?><br>
<?php echo $pokemon_id ?><br>
<img src='<?php echo $pokemon_image ?>' alt="Pokepicture"><br>
<ul><?php
    for ($x = 0; $x <= 3; $x++) { ?>
        <li><?php echo $pokemonData['moves'][$x]['move']['name'];?></li><?php
    }?>
</ul>
<?php
if ($pokemon_evolved === null) {
    echo 'This Pokémon has not been evolved yet';
} else {
    echo 'Evolved from' .$pokemon_evolved;
    //link to the picture of the Pokémon it has evolved from
    $apiEvolutionpicture = 'https://pokeapi.co/api/v2/pokemon/' . $pokemon_evolved;
    $apiEvolutionpictureString = file_get_contents($apiEvolutionpicture, true);
    $pokemonEvolutionPicture = json_decode($apiEvolutionpictureString, true);
    $pokemon_evolved_image = $pokemonEvolutionPicture['sprites']['front_default'];
    ?><br>
    <img src='<?php echo $pokemon_evolved_image ?>' alt="Image of previous"><br>
    <?php
} ?>

</body>
</html>

