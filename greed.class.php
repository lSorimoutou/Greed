<?php

/**
 * Greed
 */
class Greed 
{
    private static $three_pairs = array(2,2,3,3,4,4);
    private static $straight = array(1,2,3,4,5,6);

    private $scoring_rules;

    function __construct($scoring_rules){
        $this->scoring_rules = $scoring_rules;
    }

    public function score($dice_values){
        if(count($dice_values)> 6)
            throw new InvalidArgumentException("Vous ne pouvez pas lancer " . count($dice_values) . " dés !\n");
        
        if($dice_values === self::$three_pairs)
            return 800;
        
        if($dice_values === self::$straight)
            return 1200;
        $score = 0;
        $count_dice_values = array_count_values($dice_values);
        $multiply = 1;
        foreach ($count_dice_values as $dice => $occ) {
            if($occ===4){
                $multiply = 2;
                $occ = 3;
            }               
            if($occ===5){
                $multiply = 4;
                $occ= 3;
            }
            if($occ===6){
                $multiply = 8;
                $occ = 3;
            }   
            if($temp = array_search(array($dice => $occ), $this->scoring_rules))
                $score += $multiply * $temp;
            $multiply = 1;
        }
        return $score;
    }
}
