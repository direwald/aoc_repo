<?php

// Input processing

$file = file_get_contents(__DIR__.'/inputs/input20220112.csv');


// Part 1
// Each empty new line separates a group of calories
// Find the most calories a group is carrying

// Split input into arrays on empty new lines
$array = preg_split("#\n\s*\n#Uis", $file);

$input_array = array();

// Split calories into arrays for easier manipulation later
foreach ($array as $arr) {
    $elf_array = preg_split("/\r\n|\n|\r/", $arr);
    array_push($input_array, $elf_array);
}

// Find most calories
$max_calories = 0;
foreach ($input_array as $elf) {
    $calories = array_sum($elf);

    if ($calories > $max_calories) {
        $max_calories = $calories;
    }
}

echo('Most calories - '.$max_calories);

// Part 2
// Find top 3 most calories and add them

$calories_array = array();

// Add up each calory group
foreach ($input_array as $elf) {
    $calories = array_sum($elf);
    array_push($calories_array, $calories);
}

// Sort the array with sums of calolories in desc order
rsort($calories_array);

// Get top 3 and add them up
$top_three = array_slice($calories_array, 0, 3);
$add_up = array_sum($top_three);

echo('<br>Top three total - '.$add_up);