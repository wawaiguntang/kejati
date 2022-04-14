<?php

function getDataMenuAllModule()
{
    $menu = [];
    $allModule = scandir(APPPATH . 'modules');
    foreach ($allModule as $k => $v) {
        $pathMenu = APPPATH . 'modules\\' . $v . '\menu.json';
        if (file_exists($pathMenu)) {
            if ($v == 'dashboard') {
                $tempMenu = [];
                $tempMenu[] = json_decode(file_get_contents($pathMenu), true);
                foreach ($menu as $k => $v) {
                    $tempMenu[] = $v;
                }
                $menu = $tempMenu;
            } else {
                $menu[] = json_decode(file_get_contents($pathMenu), true);
            }
        }
    }
    return $menu;
}
