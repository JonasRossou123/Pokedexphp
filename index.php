<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="pokedex.css">
    <title>Pokedexphp</title>
</head>
<body>

<?php
//error logging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Code won't run until something's filled in
if (isset($_GET['pokemon'])) {

//pokemon added at the end of the link
    $api = 'https://pokeapi.co/api/v2/pokemon/' . $_GET['pokemon'];
//link to the Pokémon it has evolved from
    $apiEvolution = 'https://pokeapi.co/api/v2/pokemon-species/' . $_GET['pokemon'];

//checking if HTTP response is not OK or if search is NULL
//if the search engine crashes you'll get a message and the api will return the first pokemon
    $headers = get_headers($api, 1);
     if ($headers[0] !=='HTTP/1.1 200 OK' || ($_GET['pokemon']) == NULL) {

                echo "<h2>Enter a valid search</h2>";
                $api = "https://pokeapi.co/api/v2/pokemon/1";
                $apiEvolution = "https://pokeapi.co/api/v2/pokemon-species/1";
            }

//file_get_contents -> Reads entire file into a string
    $apistring = file_get_contents($api, true);
  //idem other link
    $apiEvolutionstring = file_get_contents($apiEvolution, true);
//Takes a JSON encoded string and converts (=decode) it into a PHP variable.
    $pokemonData = json_decode($apistring, true);
//idem other link
    $pokemonEvolution = json_decode($apiEvolutionstring, true);


//array to variable
    $pokemon_name = $pokemonData['name'];
    $pokemon_id = $pokemonData['id'];
    $pokemon_image = $pokemonData['sprites']['front_default'];
    if ($pokemonEvolution['evolves_from_species'] === null){
        echo "";
    }
    else {
        $pokemon_evolved = $pokemonEvolution['evolves_from_species']['name'];
    }}
?>
<!--html starts here-->
<!--if (isset($_GET['pokemon'] is being used to counter the errors of no input-->
<div id="global">
    <div id="containerleft">
        <div id="leftup">
            <div id="bluebutton"><div id="whitebutton"></div></div>
            <div id="red"></div>
            <div id="yellow"></div>
            <div id="green"></div>
            <div id="pseudo1"></div>
            <div id="pseudo2"></div>
        </div>
        <div id="left">
            <div id="leftpart1">
                <div id="whitewrapper">
                    <div id="redbutton1"> </div>
                    <div id="redbutton2"> </div>
                    <div id="stylepicturepoke">
                        <?php if (isset($_GET['pokemon'])) {?>
                            <img id="image" src='<?php echo $pokemon_image;?>' alt="ready to display" width="200" height="200" >
                        <?php } ?>

                    </div>
                    <div id="redbutton3"></div>
                    <div id="stripes"><hr color="black"><hr color="black"><hr color="black"><hr color="black"><hr color="black"></div>
                </div>
            </div>
            <div id="leftpart2">
                <form class="randbut" action="" method="get">
                    <button  type="submit" id="buttontje" class="button1" name="pokemon" value="<?php echo $pokemon_id-1 ?>"></button>
                    <button  type="submit" id="buttontje" class="button" name="pokemon" value="<?php echo $pokemon_id+1 ?>"></button>
                </form>

            </div>
            <div id="leftpart3">
                <div id="wrappercircle">
                    <div id="circleone"></div>
                    <div id="circletwo"></div>
                </div>
                <div id="wrappernameid">
                    <div id="name"><?php if (isset($_GET['pokemon'])) {echo $pokemon_name;} else {echo "Name";} ?></div>
                    <div id="id"><?php if (isset($_GET['pokemon'])) {echo $pokemon_id;} else {echo "#ID";}?></div>
                </div>
                <div id="wrapperx">
                    <div id="x">+</div>
                </div>
            </div>
        </div>
    </div>


    <div id="middle">
        <div id="rowodd1"></div>
        <div class="roweven"></div>
        <div class="rowodd"></div>
        <div class="roweven"></div>
        <div class="rowodd"></div>
        <div class="roweven"></div>
        <div class="rowodd"></div>
    </div>

    <div id="containerright">
        <div id="rightup"></div>
        <div id="right">
            <div id="rightpart1"></div>
            <div id="rightpart2">
                <div id ="wrappersearch">
                    <form class="search-poke" action="">
                        <input type="text" name="pokemon" id="pokemon" placeholder="Enter Pokémon or ID">
                        <input type="submit" name="submit" id="run" value="Search">
                    </form>
                </div>

            </div>
            <div id="rightpart3">
                <div id="stylemoves">
                    <ul id="moves">
                        <?php
                        //we use a for loop to fill iin the ul
                        //we used an extra if to counter the Pokémons that doesn't count at least 4 moves
                        if (isset($_GET['pokemon'])) {
                            $count = count($pokemonData["moves"]);
                            if ($count > 4){
                                $count = 4;
                            }
                        for ($x = 0; $x < $count; $x++) {
                            echo '<li>';
                            echo $pokemonData['moves'][$x]['move']['name'];
                            echo '</li>';
                        }}?>
                    </ul>
                </div>
            </div>
            <div id="rightpart4">
                <div id = "styleevolve">
                    <marquee behavior="scroll" direction="left">
                       <div id="evolve"> <?php
                           if (isset($_GET['pokemon'])) {
                        if ($pokemonEvolution['evolves_from_species'] === null) {
                            echo 'This Pokémon has not been evolved yet';
                        }
                        else {
                            echo 'Evolved from ' . $pokemon_evolved;
                        }}?></div>
                    </marquee>

                </div>
            </div>
            <div id="rightpart5">
                <div id="stylepictureevolve">
                    <?php
                    if (isset($_GET['pokemon'])) {
                    if ($pokemonEvolution['evolves_from_species'] === null) {
                        echo '';
                    } else {
                        //link to the picture of the Pokémon it has evolved from
                        $apiEvolutionpicture = 'https://pokeapi.co/api/v2/pokemon/' . $pokemon_evolved;
                        $apiEvolutionpictureString = file_get_contents($apiEvolutionpicture, true);
                        $pokemonEvolutionPicture = json_decode($apiEvolutionpictureString, true);
                        $pokemon_evolved_image = $pokemonEvolutionPicture['sprites']['front_default'];
                    ?>
                        <img id="imageevolve" src='<?php echo $pokemon_evolved_image;?>' alt="image" width="120" height="120">
                        <?php   }} ?>
                </div>
            </div>
            <div id="rightpart6">
                <img id="gottacatchemall" src="gotta.png" alt="gotta" height="60">
            </div>
        </div>
    </div>

</div>


</body>
</html>

