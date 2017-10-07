<?php

/**
 * Created by PhpStorm.
 * User: denis
 * Date: 26.05.17
 * Time: 17:05
 */
class Ultimate_Ads_Manager_Util
{
    public static function nearest_form($width, $height){
        global $cc_uam_config;
        $ratio = $width/$height;
        $best = 'square';
        foreach ($cc_uam_config['forms'] as $form => $dim){
            $r = $dim[0]/$dim[1];
            $best_ratio = $cc_uam_config['forms'][$best][0]/$cc_uam_config['forms'][$best][1];
            $best_dist = abs($best_ratio - $ratio);
            $curr_dist = abs($ratio - $r);
            if($curr_dist < $best_dist)
                $best = $form;

        }
        return $best;
    }
}