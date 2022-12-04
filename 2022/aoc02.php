<?php

// Input processing

$file = file_get_contents(__DIR__ . '/inputs/input20220212.csv');

$array = preg_split("/(\r\n|\n|\r)/", $file);

$input_array = array();
foreach ($array as $arr) {
    $split = explode(' ', $arr);
    array_push($input_array, $split);
}

// Part 1
// Calculate points from Rock, Paper, Scissors games in input file
// First letter is opponent's choice, seconds is yours

// Rules
// A / X  - rock - 1
// B / Y - paper - 2
// C / Z - scissors - 3
// Loss - 0
// Draw - 3
// Win - 6


$rock = 1;
$paper = 2;
$scissors = 3;

$points = [
    'A' => $rock,
    'X' => $rock,
    'B' => $paper,
    'Y' => $paper,
    'C' => $scissors,
    'Z' => $scissors,
];

$loss = 0;
$draw = 3;
$win = 6;

$match_points = array();

// Convert inoput file into numerical values of each choice
foreach ($input_array as $match) {
    foreach ($match as $key => $side) {
        if (isset($points[$side])) {
            $values[$key] = $points[$side];
        }
    }
    array_push($match_points, $values);
}

$result = 0;

// Substract choices from each other to determine whether it's a win,
// loss or draw
foreach ($match_points as $players) {
    if ($players[0] - $players[1] == 0) {
        $result += $draw + $players[1];
    } else if (($players[0] - $players[1]) == -1 || ($players[0] - $players[1]) == 2) {
        $result += $win + $players[1];
    } else {
        $result += $loss + $players[1];
    }
}

// Part 2
// First letter is stil opponent's choice, but second letter is the desired result

// rules
// X - loss
// Y - draw
// Z - win

$result_l = 1;
$result_d = 2;
$result_w = 3;

// Just an ugly if tree
$result_p2 = 0;
foreach ($match_points as $players) {
    if ($players[1] == $result_d) {
        $result_p2 += $draw + $players[0];
    } else if ($players[1] == $result_w) {
        if ($players[0] == 1) {
            $result_p2 += $win + $points['Y'];
        } else if ($players[0] == 2) {
            $result_p2 += $win + $points['Z'];
        } else {
            $result_p2 += $win + $points['X'];
        }
    } else if ($players[1] == $result_l) {
        if ($players[0] == 1) {
            $result_p2 += $loss + $points['Z'];
        } else if ($players[0] == 2) {
            $result_p2 += $loss + $points['X'];
        } else {
            $result_p2 += $loss + $points['Y'];
        }
    }
}

echo $result_p2;
