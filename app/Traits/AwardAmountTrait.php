<?php 
namespace App\Traits;

trait AwardAmountTrait {

    private function calculateAwardAmount($numWinners) {
        if ($numWinners == 1) {
            return 20000;
        } elseif ($numWinners <= 3) {
            return 5000;
        } elseif ($numWinners <= 5) {
            return 1000;
        } elseif ($numWinners <= 10) {
            return 750;  
        } elseif ($numWinners <= 15) {
            return 600;  
        } elseif ($numWinners <= 20) {
            return 500;
        } else {
            return null;
        }
    }
}