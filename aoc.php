<?php

// Input processing

$file = file_get_contents(__DIR__.'/inputs/input20220212.csv');

$array = preg_split("/(\r\n|\n|\r)(\r\n|\n|\r)/", $file);

$input_array = array();

foreach ($array as $arr) {
    $elf_array = preg_split("/\r\n|\n|\r/", $arr);
    array_push($input_array, $elf_array);
}

// Find most calories

$max_calories = 0;
foreach ($input_array as $elf) {
    $calories = 0;
    foreach ($elf as $carried_calories) {
        $calories += (int)$carried_calories;
    }

    if ($calories > $max_calories) {
        $max_calories = $calories;
    }
}

echo('Most calories - '.$max_calories);

// Find top 3 most calories and add them

$calories_array = array();

foreach ($input_array as $elf) {
    $calories = 0;
    foreach ($elf as $carried_calories) {
        $calories += (int)$carried_calories;
    }

    array_push($calories_array, $calories);
}

rsort($calories_array);

$top_three = array_slice($calories_array, 0, 3);

$add_up = array_sum($top_three);

echo('<br>Top three total - '.$add_up);

// echo '<pre>';
// echo ($add_up);
// echo '</pre>';