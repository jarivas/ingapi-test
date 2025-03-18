<?php


declare(strict_types=1);

namespace INGApi;

class TestToolHelper
{


    /**
     * Summary of division
     * @param array<float> $numbers
     * @return float
     */
    public static function division(...$numbers): float
    {
        $max    = count($numbers);
        $result = $numbers[0];

        for ($i = 1; $i < $max; ++$i) {
            $result /= $numbers[$i];
        }

        return $result;

    }//end division()


    /**
     * Summary of multiply
     * @param array<float> $numbers
     * @return float
     */
    public static function multiply(...$numbers): float
    {
        $max    = count($numbers);
        $result = $numbers[0];

        for ($i = 1; $i < $max; ++$i) {
            $result *= $numbers[$i];
        }

        return $result;

    }//end multiply()


}//end class
