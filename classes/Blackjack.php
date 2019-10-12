<?php
declare(strict_types=1);


/**
 * Class Blackjack
 */
class Blackjack
{
    public const CARD_MIN = 1;
    public const CARD_MAX = 11;
    public const TWENTY_ONE = 21;

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

    public function getCards(): array
    {
        return $this->cards;
    }

    public function Hit(): void
    {
        try {
            $random = random_int(self::CARD_MIN, self::CARD_MAX);
        } catch (Exception $e) {
            die('random failed');
        }
        $this->cards[] = $random;
        $this->score += $random;
    }

    public function Stand(Blackjack $dealer): void
    {
        session_destroy();

        $playerDiff = $this->score - self::TWENTY_ONE;
        $dealerDiff = $dealer->getScore() - self::TWENTY_ONE;

        if ($playerDiff > 0 && $dealerDiff <= 0) {
            header('location: home.php?exit=lose&player=' . $this->score . '&dealer=' . $dealer->getScore());
        }
        if ($playerDiff <= 0 && $dealerDiff > 0) {
            header('location: home.php?exit=win&player=' . $this->score . '&dealer=' . $dealer->getScore());
        }
        if ($playerDiff === $dealerDiff) {
            header('location: home.php?exit=draw&player=' . $this->score . '&dealer=' . $dealer->getScore());
        }
        if ($playerDiff <= 0 && $dealerDiff <= 0) {
            if ($playerDiff > $dealerDiff) {
                header('location: home.php?exit=win&player=' . $this->score . '&dealer=' . $dealer->getScore());
            } else {
                header('location: home.php?exit=lose&player=' . $this->score . '&dealer=' . $dealer->getScore());
            }
        }
    }

    public function Surrender(): void
    {
        header('location: home.php?exit=surr');
    }
}