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
        $patternToCheckForNumbers = "/^\d+$/";
        $data = file_get_contents($API_URL . $userInput . '/');
        $pokemon = json_decode($data);
        $pokeName = $pokemon->name;
        $pokeID = $pokemon->id;
        $pokeMoves = [];
        $pokeMovesLength = count($pokemon->moves);
        for ($i = 0; $i <= 4; $i++) {
            if ($i >= $pokeMovesLength) {
                break;
            }
            $pokeMove = $pokemon->moves[$i]->move->name;
            array_push($pokeMoves, $pokeMove);
        }
    }
    ?>

    <header>
        <h1>PHPokedex</h1>
    </header>
    <main>
        <form method="post">
            <p>Please enter the ID of the pokemon you would like to look up</p>
            <input type="text" name="searchID" id="searchPokemon">
            <input type="submit" value="Look Up Pokemon" name="lookUpPokemon">
        </form>
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
                <td colspan="4">Moves</td>
            </tr>
            <td><?php if (isset($pokeMoves[0])) {
                    echo $pokeMoves[0];
                }
                ?></td>
            <td><?php if (isset($pokeMoves[1])) {
                    echo $pokeMoves[1];
                }
                ?></td>
            <td><?php if (isset($pokeMoves[2])) {
                    echo $pokeMoves[2];
                }
                ?></td>
            <td><?php if (isset($pokeMoves[3])) {
                    echo $pokeMoves[3];
                }
                ?></td>
            <tr>

            </tr>
        </table>
    </main>


    <footer>
        <h1>
            Footer
        </h1>
    </footer>
</body>

</html>