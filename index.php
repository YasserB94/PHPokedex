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
        // $userInput = $_POST['searchID'];
        $userInput = '1';
        $API_URL = "https://pokeapi.co/api/v2/pokemon/";
        $patternToCheckForNumbers = "/^\d+$/";
        if (preg_match($patternToCheckForNumbers, $userInput)) {
            echo "Only Numbers inputed";
        }
        $patternToCheckIfFirstCharIsUpperCase = "/^[A-Z]/";
        if (preg_match($patternToCheckIfFirstCharIsUpperCase, $userInput)) {
            echo "First char is uppercase";
        }

        $data = file_get_contents($API_URL . $userInput . '/');
        $pokemon = json_decode($data);
        var_dump($pokemon);
    }
    ?>

    <header>
        <h1>PHPokedex</h1>
    </header>
    <main>
        <form method="post">
            <input type="text" name="searchID" id="searchPokemon">
            <input type="submit" value="Look Up Pokemon" name="lookUpPokemon">
        </form>

    </main>
    <footer>
        <h1>
            Footer
        </h1>
    </footer>
</body>

</html>