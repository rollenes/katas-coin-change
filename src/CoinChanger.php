<?php

namespace Rollenes\GivingChange;

class CoinChanger
{

    private $coins = [
        5,
        2,
        1,
        0.5,
        0.2,
        0.1,
        0.05,
        0.02,
        0.01,
    ];

    public function change($amount)
    {
        if ($amount < 0) {
            throw new \InvalidArgumentException('Amount must not be negative');
        }

        if ($amount == 0) {
            return [];
        }

        if (in_array($amount, $this->coins)) {
            return [$amount];
        }

        foreach ($this->coins as $firstCoin) {
            $rest = bcsub($amount, $firstCoin, 2);
            if ($rest > 0) {
                $changePart = $this->change($rest);

                return array_merge([$firstCoin], $changePart);
            }
        }
    }
}