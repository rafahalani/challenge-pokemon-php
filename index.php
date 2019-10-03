<?php

echo "<br>";

$url = "https://pokeapi.co/api/v2/pokemon";
$id = $_POST['Id_or_Name'];
$json = file_get_contents($url . '/' . $id);
$data = json_decode($json, true);

$image = $data["sprites"]["front_default"];




function getPowers($data) : array
{
    $randomPower = [];
    for ($i = 0; $i < 4; $i++) {
        $moves_random = array_rand($data["moves"]);
        $randomPower[] = $data["moves"][$moves_random]["move"]["name"];
    }
    return ($randomPower);
}

$url2 = "https://pokeapi.co/api/v2/pokemon-species";
$pokName = $data["species"]["name"];
$newJson = file_get_contents($url2 . '/' .  $pokName);
$data2 = json_decode($newJson,true);
$spiName = $data2["evolves_from_species"]["name"];

$url3 = "https://pokeapi.co/api/v2/pokemon";
$jason3 = file_get_contents($url3 . '/' . $spiName);
$data3 = json_decode($jason3,true);
$image2 = $data3["sprites"]["front_default"];
$idSpi = $data3 ["id"];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pokedex</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css.css">
    <link href="https://fonts.googleapis.com/css?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Luckiest+Guy&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">

    <div class="input-group mb-3">

        <form method="post" action="">
            Name or Id : <input type="text" name="Id_or_Name" value="">
            <button class="btn" type="submit" id="run"><i class="icon-egg"></i></button>
        </form>


    </div>
    <header>
        <h1>
            <a href="https://fontmeme.com/pokemon-font/"><img
                        src="https://fontmeme.com/permalink/190913/981e6a87cf9cbcd7f5007e49ec49e64f.png"
                        alt="pokemon-font"
                        border="0"></a>
        </h1>
    </header>
    <div class="row justify-content-center">
        <div class="col-sm-4 previousPokemon">
            <div class="imageContainer mx-auto">
                <div class="placeholder ">
                    <img id="imgPrevious" class="responsive-image" src="<?php echo "$image2" ?>">
                </div>
            </div>
            <div class="col wrapName rounded">
                Evolution from: <?php echo "$spiName"?>
                <div id="evolution"></div>
            </div>
            <div class="w-100"></div>
            <div class="col wrapId rounded">
                ID: <?php echo "$idSpi"?>
                <div id="idnum"></div>
            </div>

        </div>

        <div class="col-sm-7 currentPokemon">
            <div class="col wrapName rounded">
                Name:
                <div id="namePokemon"><?php echo $data["name"] ?></div>
            </div>

            <div class="col wrapId rounded">
                ID:
                <div id="idPokemon"><?php echo $data["id"] ?></div>
            </div>

            <div class="imageContainer mx-auto">
                <div class="placeholder mx-auto">
                    <img id="imgPokemon" src="<?php echo "$image" ?>">

                </div>
            </div>

            <div class="col wrapPower rounded"> Powers:
                <div id="target">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div> Move</div>
                            <?php
                            $randomPower = getPowers($data);
                            for ($i = 0; $i < 4 ; $i++){
                                echo '<li>';
                                echo $randomPower[$i];
                                echo '</li>';
                            }
                            ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="./js.js"></script>

</body>
</html>

