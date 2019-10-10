<?php


class Blackjack
{
    /* @var int */
    private $score;
    private $cards;

    public function __construct(int $Score, array $Cards)
    {
        $this->score = $Score;
        $this->cards = $Cards;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function Hit(): void
    {
        $random = rand($min = 1, $max = 11);
        array_push($this->cards, $random);
        $this->score += $random;
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function Stand($dealerScore)
    {
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
        header("location: home.php?exit=surr");
    }
}