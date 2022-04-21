<?php

function formatWaktu($waktu = 0)
{
    $return = '';
    $hari = 24 * 60;
    $jam = 60;
    $menit = 1;

    if (($waktu / $hari) >= 1) {
        $tempHari = number_format(($waktu / $hari), 0);
        $return .= $tempHari . ' Hari ';
    }
    if (($waktu / $jam) >= 1) {
        if (isset($tempHari)) {
            $tempJam = number_format(($waktu / $hari), 0) - ($tempHari * 24);
        } else {
            $tempJam = number_format(($waktu / $jam), 0);
        }
        $return .= $tempJam . ' Jam ';
    }
    if (($waktu / $menit) >= 1) {
        if (isset($tempJam)) {
            $tempMenit = number_format(($waktu / $menit), 0) - ($tempJam * 60);
        } else {
            $tempMenit = $waktu;
        }
        $return .= $tempMenit . ' Menit';
    }
    return $return;
}

function progress($progress = 0)
{
    if($progress < 5){
        return 0;
    }elseif($progress >= 5 && $progress < 10){
        return 5;
    }elseif($progress >= 10 && $progress < 15){
        return 10;
    }elseif($progress >= 15 && $progress < 20){
        return 15;
    }elseif($progress >= 20 && $progress < 25){
        return 20;
    }elseif($progress >= 25 && $progress < 30){
        return 25;
    }elseif($progress >= 30 && $progress < 35){
        return 30;
    }elseif($progress >= 35 && $progress < 40){
        return 35;
    }elseif($progress >= 40 && $progress < 45){
        return 40;
    }elseif($progress >= 45 && $progress < 50){
        return 45;
    }elseif($progress >= 50 && $progress < 55){
        return 50;
    }elseif($progress >= 55 && $progress < 60){
        return 55;
    }elseif($progress >= 60 && $progress < 65){
        return 60;
    }elseif($progress >= 65 && $progress < 70){
        return 65;
    }elseif($progress >= 70 && $progress < 75){
        return 70;
    }elseif($progress >= 75 && $progress < 80){
        return 75;
    }elseif($progress >= 80 && $progress < 85){
        return 80;
    }elseif($progress >= 85 && $progress < 90){
        return 85;
    }elseif($progress >= 90 && $progress < 95){
        return 90;
    }elseif($progress >= 95 && $progress < 100){
        return 95;
    }elseif($progress == 100){
        return 100;
    }
}
