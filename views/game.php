<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once '../classes/Blackjack.php';
session_start();

if (isset($_SESSION['player'], $_SESSION['playerCards'])) {
    $Player = new Blackjack($_SESSION['player'], $_SESSION['playerCards']);
} else {
    $Player = new Blackjack(0, []);
}
if (isset($_SESSION['dealer'])) {
    $Dealer = new Blackjack($_SESSION['dealer'], $_SESSION['dealerCards']);
} else {
    $Dealer = new Blackjack(0, []);
}

if (isset($_REQUEST['btn_submit'])) {
    if ($_REQUEST['btn_submit'] === 'Hit') {
        $Player->Hit();
        $_SESSION['player'] = $Player->getScore();
        $_SESSION['playerCards'] = $Player->getCards();
        if ($Player->getScore() > 21) {
            $Player->Stand($Dealer);
        }
    } else if ($_REQUEST['btn_submit'] === 'Stand') {
        while ($Dealer->getScore() < 16) {
            $Dealer->Hit();
            $_SESSION['DealerCards'] = $Dealer->getCards();
        }
        $_SESSION['dealer'] = $Dealer->getScore();
        $Player->Stand($Dealer);
    } else if ($_REQUEST['btn_submit'] === 'Surrender') {
        $Player->Surrender();
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
    <title>Blackjack: Game</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
</head>
<body>
<div class="container w-50 p-3 text-center border border-dark">
    <h1>Blackjack PhP</h1>
    <div>
        <span>Player: <?php echo $Player->getScore(); ?></span>
        <br/>
        <span>Computer: <?php echo $Dealer->getScore(); ?></span>
    </div>

    <form action="game.php" method="post">
        <input type="submit" name="btn_submit" value="Hit"/>
        <input type="submit" name="btn_submit" value="Stand"/>
        <input type="submit" name="btn_submit" value="Surrender"/>
    </form>
</div>
</body>
</html>