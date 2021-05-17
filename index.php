
<?php
error_reporting(E_ALL); ini_set("display_errors", 1);

$world = "hello world";
echo "hello world!";
?>


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
<h1><?php echo $world?></h1>
<p><?php var_dump($_GET); ?></p>
<p><?php var_dump($_GET["id"]); ?></p>

<?php
//convert json data to string
$api = file_get_contents ('https://pokeapi.co/api/v2/pokemon/1');
$api = utf8_encode($api);
$jason = json_decode ($api,true);
var_dump($jason);
//convert to json string and back to array
?>

<?php
pre_r($_POST);
?>



<p>WIE IS DEZE POKEMON?</p>
<form class="search-poke" action="" method="POST">
    <input type="text" name="pokemon" placeholder="Enter Pokémon">
    <input type="text" name="id" placeholder="Enter ID">
    <input type="submit" name="submit" value="Search">
</form>
</body>
</html>

<?php
function pre_r ($array) {
    echo'<pre>';
    print_r($array);
    echo '</pre>';
}
?>