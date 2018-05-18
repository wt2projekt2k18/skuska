<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 18-May-18
 * Time: 10:58 AM
 */

function randomstring($length)
{
    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $string = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, $max)];
    }
    return $string;
}