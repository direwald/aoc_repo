<?php

// Input processing

$file = file_get_contents(__DIR__ . '/inputs/input20220312.csv');

$array = preg_split("/(\r\n|\n|\r)/", $file);

// Part 1
// Each line is 2 rucksacks, each rucksack is exactly half of the line
// Find shared character appearing in both rucksacks
// Add all shared characters together based on a-z as 1-26 and A-Z as 27-52

// Split each line into 2 arrays corresponding to each rucksack,
// then split each rucksack into array of individual characters so we
// can compare them
$input_array = array();
foreach ($array as $arr) {
    $length = strlen($arr);
    $rucksack[0] = str_split(substr($arr, 0, $length/2 ), 1);
    $rucksack[1] = str_split(substr($arr, $length/2, $length), 1);
    array_push($input_array, $rucksack);
}

// Compare rucksack arrays and find shared character
$same_items = array();
foreach ($input_array as $rucksacks) {
    $same_item = array_intersect($rucksacks[0], $rucksacks[1]);
    array_push($same_items, array_values(array_unique($same_item)));
}

// Convert characters to ther ASCII decimal value, substract what is needed
// to make them in line with the task and add them together
$priority_sum = 0;
foreach ($same_items as $item) {
    if (ctype_lower($item[0])) {
        $priority_sum += ord($item[0]) - 96;
    } else {
        $priority_sum += ord($item[0]) - 38;
    }
}

echo '<pre>';
print_r($priority_sum);
echo '</pre>';

// Part 2
// Each line is one rucksack, each 3 lines together make a group
// in which we need to find the shared character between all 3
// rucksacks. Add them together based on the same priority as part 1

// Split input array into groups of 3
$three_group = array_chunk($array, 3);

// Split rucksacks into arrays of individual characters
$final_array = array();
foreach ($three_group as $rucks) {
    $three_split = array();
    foreach ($rucks as $backpack) {
        array_push($three_split, str_split($backpack, 1));
    }
    array_push($final_array, $three_split);
}

// Find shared characters
$all_badges = array();
foreach ($final_array as $ruck_group) {
    $badge = array_intersect($ruck_group[0], $ruck_group[1], $ruck_group[2]);
    array_push($all_badges, array_values(array_unique($badge)));
}

// Add all shared characters together
$badge_sum = 0;
foreach ($all_badges as $badger) {
    if (ctype_lower($badger[0])) {
        $badge_sum += ord($badger[0]) - 96;
    } else {
        $badge_sum += ord($badger[0]) - 38;
    }
}

echo '<pre>';
print_r($badge_sum);
echo '</pre>';

