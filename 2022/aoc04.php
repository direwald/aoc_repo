<?php

// Input processing

$file = file_get_contents(__DIR__ . '/inputs/input20220412.csv');

$array = preg_split("/(\r\n|\n|\r)/", $file);

// Part 1
// Check which ranges of numbers overlap with each other on each line

$input_array = array();

foreach ($array as $arr) {
    // Split pairs into array
    $split = explode(',',$arr);
    $range_array = array();

    // Split ranges into array
    foreach ($split as $range) {
        $range_boundary = explode('-', $range);

        $i = $range_boundary[0];
        $whole_range = array();

        // Fill out the range with all numbers in between so we can compare the arrays later
        while ($i >= $range_boundary[0] && $i <= $range_boundary[1]) {
            array_push($whole_range, $i);
            $i++;
        }
        array_push($range_array, $whole_range);
    }
    array_push($input_array, $range_array);
}

$total_overlap_counter = 0;
foreach ($input_array as $pair) {
    // Check for shared values
    $overlap = array_intersect($pair[0], $pair[1]);
    $overlap = array_values($overlap);

    // Check if there is total overlap
    if ($overlap == $pair[0] || $overlap == $pair[1]) {
        $total_overlap_counter++;
    }
}

echo '<pre>';
print_r($total_overlap_counter);
echo '</pre>';

// Part 2
// Check for any intersecting pairs, don't have to be total overlap anymore

$overlap_counter = 0;
foreach ($input_array as $pairs) {
    $overlap = array_intersect($pairs[0], $pairs[1]);
    $overlap = array_values($overlap);

    // Just need to check that there is any overlap, no need for total
    if ($overlap) {
        $overlap_counter++;
    }
}

echo '<pre>';
print_r($overlap_counter);
echo '</pre>';