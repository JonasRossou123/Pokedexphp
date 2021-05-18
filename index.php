<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>


<?php
//Code won't run until something's filled in
if (isset($_GET['pokemon'])) {

//pokemon added at the end of the link
    $api = 'https://pokeapi.co/api/v2/pokemon/'.$_GET['pokemon'];
//link to the Pokémon it has evolved from
    $apiEvolution = 'https://pokeapi.co/api/v2/pokemon-species/'.$_GET['pokemon'];

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
    $pokemon_type = '';

}
?>


//pre_r($_POST);

<p>WIE IS DEZE POKEMON?</p>
<form class="search-poke" action="">
    <input type="text" name="pokemon" placeholder="Enter Pokémon or ID">
        <input type="submit" name="submit" value="Search">
</form>



<?php echo $pokemon_name ?><br>
<?php echo $pokemon_evolved ?>

</body>
</html>

//function pre_r ($array) {
    //echo'<pre>';
    //print_r($array);
    //echo '</pre>';
//}
