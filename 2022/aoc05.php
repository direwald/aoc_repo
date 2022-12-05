<?php

// Input processing

$file = file_get_contents(__DIR__ . '/inputs/input20220512.csv');

$array = preg_split("/(\r\n|\n|\r)/", $file);

// Part 1
// First part of input represents stacked conatainers, second part
// represents how many containers should move and from which column
// and to where. Containers move 1 by 1, even if the move order is for multiple containers


// Parse the input into container array and move array
$move_array = array();
$container_array = array();

foreach ($array as $arr) {
    // Find container rows, regex match 3 characters (can be spaces) and a space
    // and put them into an array. We need white spaces to be their own value for later
    if (strpos($arr, 'move') === false && strpos($arr, '1') === false) {
        $row = preg_match_all('/.{4}|.{3}$/', $arr, $one_row);
        if ($one_row[0]) {
            array_push($container_array, $one_row[0]);
        }
    } else if (strpos($arr, 'move') !== false) { // Put move rows into its own arrays for now
        if ($arr) {
            array_push($move_array, $arr);
        }
    }
}

// Rotate container array 90 degrees, so we have one column of containers in one array
// This is why we kept white spaces as values
array_unshift($container_array, null);
$container_array = call_user_func_array('array_map', $container_array);
$container_array = array_map('array_reverse', $container_array);

// Remove empty values, don't need them anymore
foreach ($container_array as &$stack) {
    $stack = array_map('trim', $stack);
    $stack = array_filter($stack);
    unset($stack);
}

$original_array = $container_array;

// Organize move array into arrays of 'move command' => 'number'
$move_command = array();
$move_commands = array();

foreach ($move_array as $command) {
    preg_match_all('/\w*\s\d+/', $command, $moves_array);
    foreach ($moves_array[0] as $move) {
        $comm = explode(' ', $move);
        $mov_arr[$comm[0]] = $comm[0] != 'move' ? (int)$comm[1] - 1 : (int)$comm[1];
    }
    array_push($move_commands, $mov_arr);
}

foreach ($move_commands as $move_it) {

    $i = 1;
    while ($i <= $move_it['move']) {
        $last = array_pop($container_array[$move_it['from']]);
        array_push($container_array[$move_it['to']], $last);
        $i++;
    }
}



$result = '';
foreach ($container_array as $final_order) {
    $result .= array_slice($final_order, -1)[0];
}
$result = str_replace('[', '', $result);
$result = str_replace(']', '', $result);
echo '<pre>';
print_r($result);
echo '</pre>';

// Part 2
// Move all containers in a move order move at once, not 1 by 1.


foreach ($move_commands as $move_it) {
    $last_x = array_slice($original_array[$move_it['from']], -(int)$move_it['move']);

    $i = 1;
    while ($i <= (int)$move_it['move']) {
        array_pop($original_array[$move_it['from']]);
        $i++;
    }

    foreach ($last_x as $container) {
        array_push($original_array[$move_it['to']], $container);
    }
}

$result_two = '';
foreach ($original_array as $final_order) {
    $result_two .= array_slice($final_order, -1)[0];
}
$result_two = str_replace('[', '', $result_two);
$result_two = str_replace(']', '', $result_two);
echo '<pre>';
print_r($result_two);
echo '</pre>';
