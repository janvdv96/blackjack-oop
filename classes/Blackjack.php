<?php


class Blackjack
{
    const CARD_MIN = 1;
    const CARD_MAX = 11;

    /* @var int */
    private $score;

    /* @var array */
    private $cards;


    public function __construct(int $_score, array $_cards)
    {
        $this->score = $_score;
        $this->cards = $_cards;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function Hit(): void
    {
        try {
            $random = random_int(self::CARD_MIN, self::CARD_MAX);
        } catch (Exception $e) {
            die("random failed lmao");
        }
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
            header("location: home.php?exit=yikes&player=" . $this->score . "&dealer=" . $dealerScore);
        }
        if ($this->score < 21 && $dealerScore < 21 && $this->score > $dealerScore) {
            header("location: home.php?exit=win&player=" . $this->score . "&dealer=" . $dealerScore);
        }
        if ($this->score < 21 && $dealerScore < 21 && $this->score < $dealerScore) {
            header("location: home.php?exit=lose&player=" . $this->score . "&dealer=" . $dealerScore);
        }
        if ($this->score < 21 && $dealerScore > 21) {
            header("location: home.php?exit=win&player=" . $this->score . "&dealer=" . $dealerScore);
        }
        if ($this->score == $dealerScore) {
            header("location: home.php?exit=draw&player=" . $this->score . "&dealer=" . $dealerScore);
        }
        if ($this->score == 21 && $dealerScore != 21) {
            header("location: home.php?exit=win&player=" . $this->score . "&dealer=" . $dealerScore);
        }
        if ($this->score < 21 && $dealerScore == 21) {
            header("location: home.php?exit=yikes&player=" . $this->score . "&dealer=" . $dealerScore);
        }
    }

    public function Surrender()
    {
        header("location: home.php?exit=surr");
    }
}