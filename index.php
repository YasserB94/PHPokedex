<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Home Page Pokedex</title>
</head>

<body>
    <?php
    if (isset($_POST['lookUpPokemon'])) {
        $userInput = $_POST['searchID'];
        $API_URL = "https://pokeapi.co/api/v2/pokemon/";
        $data = @file_get_contents($API_URL . $userInput . '/');
        if ($data) {
            $pokemon = json_decode($data);
            $pokeName = $pokemon->name;
            $pokeID = $pokemon->id;
            $pokeMoves = [];
            $pokeMovesLength = count($pokemon->moves);
            for ($i = 0; $i < 4; $i++) {
                if ($i >= $pokeMovesLength) {
                    break;
                }
                $pokeMove = $pokemon->moves[$i]->move->name;
                array_push($pokeMoves, $pokeMove);
            }
            if ($pokeMovesLength > 4) {
                $amountOfOtherMoves = $pokeMovesLength - 4;
                array_push($pokeMoves, $amountOfOtherMoves);
            }
            $pokemonSpriteURL = $pokemon->sprites->front_default;
            $pokemonSpeciesURL = $pokemon->species->url;
            $pokemonSpeciesDATA = file_get_contents($pokemonSpeciesURL);
            $pokemonSpecies = json_decode($pokemonSpeciesDATA);
            $pokemonEvoChainURL = $pokemonSpecies->evolution_chain->url;
            $pokemonEvoChainData = file_get_contents($pokemonEvoChainURL);
            $pokemonEvoChain = json_decode($pokemonEvoChainData);
            $evolutions = [];
            $baseForm = $pokemonEvoChain->chain->species->name;
            array_push($evolutions, $baseForm);
            $amountOfEvolutions = count($pokemonEvoChain->chain->evolves_to);
            if ($amountOfEvolutions > 0) {
                echo 'This Pokemon has ' . $amountOfEvolutions . ' Evolutions';
            }
        } else {
            $patternToCheckForNumbers = "/^\d+$/";
            if (preg_match($patternToCheckForNumbers, $userInput)) {
                $error = $userInput;
                $message = ' is NOT a valid ID';
                $errormessage =  $error . $message;
            } else {
                $error = $userInput;
                $message = ' is not a pokemon in our database ={';
                $errormessage = $error . $message;
            }
        }
    }
    ?>

    <header>
        <h1>PHPokedex</h1>
    </header>
    <main>
        <form method="post">
            <p><?php if (isset($errormessage)) {
                    echo $errormessage;
                }
                ?></p>
            <p>Please enter the ID of the pokemon you would like to look up</p>
            <input type="text" name="searchID" id="searchPokemon">
            <input type="submit" value="Look Up Pokemon" name="lookUpPokemon">
        </form>
        <?php if (isset($pokemonSpriteURL)) {
            echo "<img src=$pokemonSpriteURL>";
        }
        ?>
        <table>
            <tr>
                <td>Name:</td>
                <td><?php if (isset($pokeName)) {
                        echo $pokeName;
                    } ?></td>
            </tr>
            <tr>
                <td>ID: </td>
                <td><?php if (isset($pokeID)) {
                        echo $pokeID;
                    } ?></td>
            </tr>
            <tr>
                <td>Moves</td>
            </tr>
            <tr>
                <td>
                    <ul>
                        <li><?php if (isset($pokeMoves[0])) {
                                echo $pokeMoves[0];
                            }
                            ?></li>
                        <li><?php if (isset($pokeMoves[1])) {
                                echo $pokeMoves[1];
                            }
                            ?></li>
                        <li><?php if (isset($pokeMoves[2])) {
                                echo $pokeMoves[2];
                            }
                            ?></li>
                        <li><?php if (isset($pokeMoves[3])) {
                                echo $pokeMoves[3];
                            }
                            ?></li>
                        <li>
                            <?php if (isset($pokeMoves[4])) {
                                echo 'and ' . $pokeMoves[4] . ' more.';
                            } else {
                                echo 'That is it, this pokemon can only learn ' . $pokeMovesLength . ' moves';
                            }

                            ?>
                        </li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td>Evolution chain</td>
            </tr>
            <tr>
                <td>
                    <ul>
                        <li>
                            <?php if (isset($evolutions[0])) {
                                echo $evolutions[0];
                            } ?>
                        </li>
                        <li>Evo2</li>
                        <li>Evo3</li>
                    </ul>
                </td>
            </tr>
        </table>
    </main>


    <footer>
        <h1>
        </h1>
    </footer>
</body>

</html>