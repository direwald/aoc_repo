<?php

// Input processing

$file = file_get_contents(__DIR__ . '/inputs/input20220312.csv');

$array = preg_split("/(\r\n|\n|\r)/", $file);

$input_array = array();
foreach ($array as $arr) {
    $length = strlen($arr);
    $rucksack[0] = str_split(substr($arr, 0, $length/2 ), 1);
    $rucksack[1] = str_split(substr($arr, $length/2, $length), 1);
    array_push($input_array, $rucksack);
}

$same_items = array();
foreach ($input_array as $rucksacks) {
    $same_item = array_intersect($rucksacks[0], $rucksacks[1]);
    array_push($same_items, array_values(array_unique($same_item)));
}

$priority_sum = 0;
foreach ($same_items as $item) {
    if (ctype_lower($item[0])) {
        $priority_sum += ord($item[0]) - 96;
    } else {
        $priority_sum += ord($item[0]) - 38;
    }
}

echo $priority_sum;

// part 2

$three_group = array_chunk($array, 3);

$final_array = array();
foreach ($three_group as $rucks) {
    $three_split = array();
    foreach ($rucks as $backpack) {
        array_push($three_split, str_split($backpack, 1));
    }
    array_push($final_array, $three_split);
}

$all_badges = array();
foreach ($final_array as $ruck_group) {
    $badge = array_intersect($ruck_group[0], $ruck_group[1], $ruck_group[2]);
    array_push($all_badges, array_values(array_unique($badge)));
}

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

