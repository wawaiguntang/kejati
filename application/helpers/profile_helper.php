<?php

/**
 * get all profile in file json
 * @return array
 */
function getProfileWeb():array
{
    $json = file_get_contents(APPPATH.'\setting\profile_web.json');
    return json_decode($json,true);
}