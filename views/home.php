<?php

if ($_GET["exit"] == "surr"){
    $message = "You lose! You gave up!";
}

if (isset($_GET["exit"]) && isset($_GET["player"]) && isset($_GET["dealer"])) {
    switch ($_GET["exit"]) {
        case "win":
            $message = "You win! You had: " . $_GET["player"] . ", Dealer had: " . $_GET["dealer"];
            break;
        case "draw":
            $message = "It's a draw! You had: " . $_GET["player"] . ", Dealer had: " . $_GET["dealer"];
            break;
        case "lose":
            $message = "You lose! You had: " . $_GET["player"] . ", Dealer had: " . $_GET["dealer"];
            break;
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blackjack: Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
</head>
<body>

<div class="container w-50 p-3 text-center">
    <h1>Blackjack PhP</h1>
    <?php if (isset($_GET["exit"])) {
        echo '<div class="alert alert-info mb-2 p-1" role="alert">' . $message . '</div>';
    } ?>

    <form action="game.php" method="post">
        <input type="submit" value="Start Game"/>
    </form>
</div>

</body>
</html>
