<?php

namespace App\Services;

use App\Entity\Character;

class ActionResolver
{
    private $diceThrower;

    public function __construct(DiceThrower $diceThrower)
    {
        $this->diceThrower = $diceThrower;
    }

    /**
     * @param Character $character1
     * @param Character $character2
     */
    public function attack(Character $character1, Character $character2)
    {
        $testAttack = $this->diceThrower->rollHundred(1);

        if ($testAttack > $character1->getStrength()) {
            return null;
        }

        $testDefense = $this->diceThrower->rollHundred(1);
        if ($testDefense <= $character2->getDefense()) {
            return null;
        }

        $damageDices = $this->diceThrower->rollTwenty(6);

        return array_sum($damageDices);
    }
}