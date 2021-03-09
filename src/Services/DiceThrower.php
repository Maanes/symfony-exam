<?php

namespace App\Services;

class DiceThrower
{
    /**
     * @param int $nbDices
     * @param int $nbFaces
     */
    public function rollDices(int $nbDices, int $nbFaces)
    {
        $resultDices = [];

        if ($nbDices > 0 && $nbFaces > 1) {
            for ($i = 0; $i < $nbDices; $i++) {
                $resultDices[] = rand(1, $nbFaces);
            }

            return $resultDices;
        }
    }

    /**
     * @param  int $nbDices
     */

    public function rollTwenty(int $nbDices)
    {
        $resultDices = [];

        if ($nbDices > 0) {
            for ($i = 0 ; $i < $nbDices ; $i++) {
                $resultDices[] = rand(1, 20);
            }

            return $resultDices;
        }
    }

    /**
     * @param  int $nbDices
     */
    public function rollHundred(int $nbDices)
    {
        $resultDices = [];

        if ($nbDices > 0) {
            for ($i = 0 ; $i < $nbDices ; $i++) {
                $resultDices[] = rand(1, 100);
            }

            return $resultDices;
        }
    }
}