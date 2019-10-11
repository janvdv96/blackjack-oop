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
            die("random failed");
        }
        array_push($this->cards, $random);
        $this->score += $random;
    }

    public function getCards(): array
    {
        return $this->cards;
    }

    public function Stand(Blackjack $dealer)
    {
        session_destroy();

        $playerDiff = $this->score - 21;
        $dealerDiff = $dealer->getScore() - 21;

        if ($playerDiff > 0 && $dealerDiff <= 0) {
            header("location: home.php?exit=lose&player=" . $this->score . "&dealer=" . $dealer->getScore());
        }
        if ($playerDiff <= 0 && $dealerDiff > 0) {
            header("location: home.php?exit=win&player=" . $this->score . "&dealer=" . $dealer->getScore());
        }
        if ($playerDiff == $dealerDiff){
            header("location: home.php?exit=draw&player=" . $this->score . "&dealer=" . $dealer->getScore());
        }
        if ($playerDiff <= 0 && $dealerDiff < 0){
            if ($playerDiff > $dealerDiff){
                header("location: home.php?exit=win&player=" . $this->score . "&dealer=" . $dealer->getScore());
            }
            else {
                header("location: home.php?exit=lose&player=" . $this->score . "&dealer=" . $dealer->getScore());
            }
        }
    }

    public function Surrender()
    {
        header("location: home.php?exit=surr");
    }
}