<?php


class Blackjack
{
    /* @var int */
    private $score;

    public function __construct($Score)
    {
        $this->score = $Score;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function Hit(): void
    {
        $random = rand($min = 1, $max = 11);
        $this->score += $random;
    }

    public function Stand($dealerScore)
    {
        // should end your turn and start the dealer's turn. (Your point total is saved.)
        session_destroy();
        if ($this->score > 21) {
            header("location: home.php?exit=lose&player=" . $this->score . "&dealer=" . $dealerScore);
        }
        if ($this->score < 21 && $dealerScore < 21 && $this->score > $dealerScore) {
            header("location: home.php?exit=win&player=" . $this->score . "&dealer=" . $dealerScore);
        }
        if ($this->score < 21 && $dealerScore < 21 && $this->score < $dealerScore) {
            header("location: home.php?exit=lose&player=" . $this->score . "&dealer=" . $dealerScore);
        }
        if ($this->score == $dealerScore) {
            header("location: home.php?exit=draw&player=" . $this->score . "&dealer=" . $dealerScore);
        }
        if ($this->score == 21 && $dealerScore != 21){
            header("location: home.php?exit=win&player=" . $this->score . "&dealer=" . $dealerScore);
        }
    }

    public function Surrender()
    {
        // should make you surrender the game. (Dealer wins.)
        header("location: home.php?exit=surr");
    }
}