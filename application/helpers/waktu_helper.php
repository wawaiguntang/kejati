<?php
date_default_timezone_set("Asia/Jakarta");
function formatWaktu($waktu = 0)
{
    $return = '';
    $hari = 24 * 60;
    $jam = 60;
    $menit = 1;
    if (((int)$waktu / $hari) >= 1) {
        $tempHari = (int)number_format(((int)$waktu / $hari), 0);
        $return .= $tempHari . ' Hari ';
    }
    if (((int)$waktu / $jam) >= 1) {
        if (isset($tempHari)) {
            $tempJam = $waktu - ($tempHari * 24 * 60);
            $tempJam = (int)number_format(($tempJam / $jam), 0);
        } else {
            $tempJam = (int)number_format(((int)$waktu / $jam), 0);
        }
        $return .= $tempJam . ' Jam ';
    }
    if (((int)$waktu / $menit) >= 1) {
        if (isset($tempJam)) {
            if(isset($tempHari)){
                $tempMenit = $waktu - (($tempJam * 60) + ($tempHari * 24 * 60));
            }else{
                $tempMenit = $waktu - (($tempJam * 60));
            }
        } else {
            $tempMenit = $waktu;
        }
        $return .= $tempMenit . ' Menit';
    }
    return $return;
}

function progress($progress = 0)
{
    if ($progress < 5) {
        return 0;
    } elseif ($progress >= 5 && $progress < 10) {
        return 5;
    } elseif ($progress >= 10 && $progress < 15) {
        return 10;
    } elseif ($progress >= 15 && $progress < 20) {
        return 15;
    } elseif ($progress >= 20 && $progress < 25) {
        return 20;
    } elseif ($progress >= 25 && $progress < 30) {
        return 25;
    } elseif ($progress >= 30 && $progress < 35) {
        return 30;
    } elseif ($progress >= 35 && $progress < 40) {
        return 35;
    } elseif ($progress >= 40 && $progress < 45) {
        return 40;
    } elseif ($progress >= 45 && $progress < 50) {
        return 45;
    } elseif ($progress >= 50 && $progress < 55) {
        return 50;
    } elseif ($progress >= 55 && $progress < 60) {
        return 55;
    } elseif ($progress >= 60 && $progress < 65) {
        return 60;
    } elseif ($progress >= 65 && $progress < 70) {
        return 65;
    } elseif ($progress >= 70 && $progress < 75) {
        return 70;
    } elseif ($progress >= 75 && $progress < 80) {
        return 75;
    } elseif ($progress >= 80 && $progress < 85) {
        return 80;
    } elseif ($progress >= 85 && $progress < 90) {
        return 85;
    } elseif ($progress >= 90 && $progress < 95) {
        return 90;
    } elseif ($progress >= 95 && $progress < 100) {
        return 95;
    } elseif ($progress == 100) {
        return 100;
    }
}


function time_ago($timestamp)
{
    $time_ago = strtotime($timestamp);
    $current_time = time();
    $time_difference = $current_time - $time_ago;
    $seconds = $time_difference;
    $minutes      = round($seconds / 60);        // value 60 is seconds  
    $hours        = round($seconds / 3600);       //value 3600 is 60 minutes * 60 sec  
    $days         = round($seconds / 86400);      //86400 = 24 * 60 * 60;  
    $weeks        = round($seconds / 604800);     // 7*24*60*60;  
    $months       = round($seconds / 2629440);    //((365+365+365+365+366)/5/12)*24*60*60  
    $years        = round($seconds / 31553280);   //(365+365+365+365+366)/5 * 24 * 60 * 60  
    if ($seconds <= 60) {
        return "Just Now";
    } else if ($minutes <= 60) {
        if ($minutes == 1) {
            return "one minute ago";
        } else {
            return "$minutes minutes ago";
        }
    } else if ($hours <= 24) {
        if ($hours == 1) {
            return "an hour ago";
        } else {
            return "$hours hrs ago";
        }
    } else if ($days <= 7) {
        if ($days == 1) {
            return "yesterday";
        } else {
            return "$days days ago";
        }
    } else if ($weeks <= 4.3) {  //4.3 == 52/12
        if ($weeks == 1) {
            return "a week ago";
        } else {
            return "$weeks weeks ago";
        }
    } else if ($months <= 12) {
        if ($months == 1) {
            return "a month ago";
        } else {
            return "$months months ago";
        }
    } else {
        if ($years == 1) {
            return "one year ago";
        } else {
            return "$years years ago";
        }
    }
}
