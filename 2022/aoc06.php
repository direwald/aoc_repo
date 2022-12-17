<?php

// Input processing

$file = file_get_contents(__DIR__ . '/inputs/input20220612.csv');

$input = $file;

// Part 1
// Find the first occurance of 4 characters that do not repeat themselves

// Split string into array by letter

$array = str_split($input);

$compare = array();
$i = 1;

foreach ($array as $char) {
    if (!in_array($char, $compare) && $compare == array_unique($compare) && $i >= 4) {
        echo '<pre>';
        echo $i-1;
        echo '</pre>';
        break;
    }
    $compare[$i%4] = $char;
    $i++;
}

// Part 2
// // Find the first occurance of 14 characters that do not repeat themselves

$array = str_split($input);

$compare = array();
$i = 1;

foreach ($array as $character) {
    if (!in_array($character, $compare) && $compare == array_unique($compare) && $i >= 14) {
        echo '<pre>';
        echo $i-1;
        echo '</pre>';
        break;
    }
    // echo '<pre>';
    // print_r($compare);
    // echo '</pre>';
    $compare[$i%14] = $character;
    $i++;
}